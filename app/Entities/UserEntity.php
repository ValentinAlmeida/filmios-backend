<?php

namespace App\Entities;

use App\Core\Contracts\Authenticable;
use App\Core\DTO\CreateUserDTO;
use App\Core\DTO\RestoreUserDTO;
use App\Core\Entity;
use App\Core\Property\UserProperty;
use App\Core\VO\Identifier;
use DateTimeInterface;

class UserEntity extends Entity implements Authenticable
{
    private ?string $url;
    private UserProperty $props;

    public function __construct(
        UserProperty $props,
        ?Identifier $identifier = null
    ) {
        $this->props = $props;

        parent::__construct(
            $identifier
        );
    }

    public static function create(
        CreateUserDTO $createUserDTO
    ): self {
        $props = new UserProperty(
            $createUserDTO->password,
            $createUserDTO->email,
            $createUserDTO->login,
            $createUserDTO->name,
            $createUserDTO->blocked,
            $createUserDTO->active,
            null,
            null,
        );

        $user = new self($props);
        $user->setUrl($createUserDTO->url);

        return $user;
    }

    public static function restore(
        RestoreUserDTO $restoreUserDTO,
        int $id
    ): self {
        $props = new UserProperty(
            $restoreUserDTO->password,
            $restoreUserDTO->email,
            $restoreUserDTO->login,
            $restoreUserDTO->name,
            $restoreUserDTO->blocked,
            $restoreUserDTO->active,
            $restoreUserDTO->created_at,
            $restoreUserDTO->updated_at
        );

        return new self($props, Identifier::create($id));
    }

    public function getEmail(): ?string
    {
        return $this->props->email;
    }

    public function getName(): ?string
    {
        return $this->props->name;
    }

    public function getLogin(): ?string
    {
        return $this->props->login;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->props->created_at;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->props->updated_at;
    }

    public function getPassword(): ?string
    {
        return $this->props->password;
    }

    public function isBlocked(): bool
    {
        return $this->props->block;
    }

    public function isActive(): bool
    {
        return $this->props->active;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }
}
