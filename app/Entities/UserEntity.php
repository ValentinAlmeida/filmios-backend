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
    private readonly ?string $profileRef;
    private readonly ?array $localitiesRef;
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
            $createUserDTO->login,
            $createUserDTO->cpf,
            $createUserDTO->password,
            $createUserDTO->email,
            $createUserDTO->blocked,
            $createUserDTO->active,
            null,
            null,
            null,
            $createUserDTO->name,
            $createUserDTO->telephone
        );

        $user = new self($props);

        $user->setProfileRef($createUserDTO->profileRef);
        $user->setLocalitiesRef($createUserDTO->localitiesRef);
        $user->setUrl($createUserDTO->url);

        return $user;
    }

    public static function restore(
        RestoreUserDTO $restoreUserDTO,
        int $id
    ): self {
        $props = new UserProperty(
            $restoreUserDTO->login,
            $restoreUserDTO->cpf,
            $restoreUserDTO->password,
            $restoreUserDTO->email,
            $restoreUserDTO->blocked,
            $restoreUserDTO->active,
            $restoreUserDTO->created_at,
            $restoreUserDTO->profile,
            $restoreUserDTO->localities,
            $restoreUserDTO->name,
            $restoreUserDTO->telephone
        );

        $user = new self($props, Identifier::create($id));

        $user->setProfileRef($restoreUserDTO->profile?->getKey());
        $user->setLocalitiesRef($restoreUserDTO->localities ? array_map(
            fn (?DomainEntity $locality) => $locality?->getIdentifier()->getValue(),
            $restoreUserDTO->localities
        ) : null);

        return $user;
    }

    public function setProfileRef(?string $profileRef)
    {
        $this->profileRef = $profileRef;
    }

    public function setLocalitiesRef(?array $localitiesRef)
    {
        $this->localitiesRef = $localitiesRef;
    }

    public function setProfile(?DomainEntity $profile)
    {
        $this->props->profile = $profile;
    }

    public function setLocalities(?array $localities)
    {
        $this->props->localities = $localities;
    }

    public function getProfileRef(): ?string
    {
        return $this->profileRef;
    }

    public function getLocalitiesRef(): ?array
    {
        return $this->localitiesRef;
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

    public function getTelephone(): ?string
    {
        return $this->props->telephone;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->props->created_at;
    }

    public function getPassword(): ?string
    {
        return $this->props->password;
    }

    public function getCpf(): ?string
    {
        return $this->props->cpf;
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

    public function getProfile(): ?ProfileEntity
    {
        return $this->props->profile;
    }

    public function getLocalities(): ?array
    {
        return $this->props->localities;
    }
}
