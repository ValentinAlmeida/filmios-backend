<?php

namespace App\Eloquent\Services;

use App\Contracts\Repositories\UserRepositoryInterface;
use App\Contracts\Services\AuthenticationServiceInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Core\Contracts\Authenticable;
use App\Core\Contracts\Token;
use App\Core\Contracts\UnitOfWorkInterface;
use App\Core\DTO\RecoveryPasswordDTO;
use App\Core\DTO\RefreshTokenDTO;
use App\Core\DTO\ResetPasswordDTO;
use App\Core\DTO\UpdateUserDTO;
use App\Core\Filters\UserFilter;
use App\Core\VO\Credential;
use App\Core\VO\TokenJwt;
use App\Entities\Mapper\UserMapper;
use App\Entities\UserEntity;
use App\Exceptions\AuthenticationException;
use App\Exceptions\AuthorizationException;
use App\Exceptions\UserException;
use App\Infra\Helpers\TokenHelper;
use App\Models\UserModel;
use App\Support\Serializers\UserSerializer;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Lcobucci\JWT\UnencryptedToken;

class AuthenticationService implements AuthenticationServiceInterface
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    )
    {
    }

    public function refreshToken(RefreshTokenDTO $refreshTokenDTO): Response
    {
        $refreshToken = $refreshTokenDTO->refresh_token;

        $payload = TokenJwt::getPayload('authenticated', app('token'));
        throw_if(!($payload['refresh_token'] == $refreshToken), AuthenticationException::invalidToken($refreshToken));

        TokenJwt::validate(TokenJwt::parse($refreshToken), true);
        $refreshToken = TokenJwt::parseForStatic($refreshToken);

        $user = $this->userRepository->findById((int)app('user')->getIdentifier()->getValue());

        return TokenHelper::refreshToken($this->generateToken($user, $refreshToken), $refreshToken);
    }

    public function authenticate(Credential $credential): Authenticable
    {
        $userFilter = new UserFilter();
        $userFilter->login = $credential->login;

        $user = $this->userRepository->search($userFilter)->getEntity();
        $user = end($user);

        throw_if(empty($user), UserException::notFound());

        $this->verifyPassword($credential->password, $user);
        $this->verifyActive($user);

        return $user;
    }

    private function verifyPassword(string $password, UserEntity $user): void
    {
        throw_if(
            $this->isNotAuthenticated($password, $user),
            AuthenticationException::credentialsInvalid()
        );
    }

    private function isNotAuthenticated(string $password, UserEntity $user): bool
    {
        return !Hash::check($password, $user->getPassword());
    }

    private function verifyActive(UserEntity $user): void
    {
        throw_if(
            $this->userIsInactive($user),
            AuthorizationException::prohibitedAuthenticate('user', UserModel::BLOCK),
        );
    }

    private function userIsInactive(UserEntity $user): bool
    {
        return $user->isBlocked();
    }

    public function generateToken(UserEntity $user, Token $refreshToken, array $extra = null): Token
    {
        return TokenJwt::generate('authenticated', TokenHelper::withRefreshToken(UserSerializer::parseEntityDecode($user), $refreshToken));
    }

    public function generateRefreshToken(UserEntity $user, array $extra = null): Token
    {
        return TokenJwt::generate('refresh_token', $user->getIdentifier()->getValue(),env('TIME_REFRESH_JWT') ?? '+120 minutes');
    }

    public function validateToken(string $token, ?bool $refresh = null): Token
    {
        $parsedToken = $this->extractAndParseToken($token);

        if(!$refresh)
        {
            $this->validateParsedToken($parsedToken);
        }

        return TokenJwt::transform('authenticated', $parsedToken);
    }

    private function extractAndParseToken(string $token): UnencryptedToken
    {
        if (!$this->isBearerToken($token)) {
            throw AuthenticationException::invalidToken($token);
        }

        $token = substr($token, 7);
        if (!$token) {
            throw AuthenticationException::tokenNotFound();
        }

        return $this->parseToken($token);
    }

    private function isBearerToken(string $token): bool
    {
        return substr($token, 0, 7) === 'Bearer ';
    }

    private function parseToken(string $token): UnencryptedToken
    {
        try {
            return TokenJwt::parse($token);
        } catch (\Lcobucci\JWT\Token\InvalidTokenStructure | \Lcobucci\JWT\Encoding\CannotDecodeContent $th) {
            throw AuthenticationException::invalidToken($token);
        }
    }

    private function validateParsedToken(UnencryptedToken $parsedToken): void
    {
        throw_if(!TokenJwt::validate($parsedToken), AuthenticationException::invalidToken($parsedToken->toString()));
    }

    public function getAuthenticableByToken(string $token, ?bool $refresh = null): Authenticable
    {
        $token = $this->validateToken($token, $refresh);
        $payload = TokenJwt::getPayload('authenticated', $token->toString());

        return UserMapper::parseArrayToEntity($payload);
    }

    public function getAuthenticableByTokenRecovery(string $token): Authenticable
    {
        $token = $this->validateToken($token);
        $payload = TokenJwt::getPayload('recovery_password', $token->toString());

        return UserMapper::parseRecoveryToEntity($payload);
    }

    public function unblockAccess(int $id): void
    {
        $updateUserDTO = new UpdateUserDTO();
        $updateUserDTO->blocked = false;

        $userService = App::make(UserServiceInterface::class);

        $userService->update($id, $updateUserDTO);
    }

    public function recoverPassword(RecoveryPasswordDTO $recoveryPasswordDTO)
    {
        $unitOfWork = App::make(UnitOfWorkInterface::class);

        $unitOfWork->run(fn() => $this->userRepository->recoverPassword($recoveryPasswordDTO));
    }

    public function resetPassword(ResetPasswordDTO $resetPasswordDTO)
    {
        $this->userRepository->resetPassword($resetPasswordDTO, app('user_recovery'));
    }
}
