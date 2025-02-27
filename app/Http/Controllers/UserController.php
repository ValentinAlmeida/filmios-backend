<?php

namespace App\Http\Controllers;

use App\Contracts\Services\UserServiceInterface;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\SearchUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Infra\Helpers\PaginationHelper;
use App\Support\Serializers\UserSerializer;

class UserController extends Controller
{
    public function __construct(private readonly UserServiceInterface $userService){}

    public function createNoProfile(CreateUserRequest $request)
    {
        $this->userService->create($request->getData());

        return response(null, 201);
    }

    public function search(SearchUserRequest $request)
    {
        return PaginationHelper::convertPagingArray($this->userService->search($request->getData()), UserSerializer::class);
    }

    public function findById(int $id)
    {
        return response(UserSerializer::parseEntity($this->userService->findById($id)));
    }

    public function searchUserLogged()
    {
        return response(UserSerializer::parseEntity($this->userService->findById((int)app('user')->getIdentifier()->getValue())));
    }

    public function modifyState(int $id)
    {
        $this->userService->modifyState($id);
    }

    public function update(int $id, UpdateUserRequest $request)
    {
        $this->userService->update($id, $request->getData());

        return response(null, 204);
    }

    public function delete(int $id)
    {
        $this->userService->delete($id);

        return response('', 204);
    }
}
