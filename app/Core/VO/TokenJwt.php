<?php

namespace App\Core\VO;

use App\Core\Contracts\Token;
use App\Exceptions\AuthenticationException;
use Carbon\Carbon;
use DateTimeImmutable;
use DateTimeInterface;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\JwtFacade as Facade;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token as JWTToken;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\UnencryptedToken;
use Lcobucci\JWT\Validation\Constraint\SignedWith;
use Lcobucci\JWT\Validation\Validator;

class TokenJwt implements Token
{
    private UnencryptedToken $value;

    private function __construct(
        private readonly ?string $payload_name = null,
        private readonly mixed $payload,
        ?UnencryptedToken $token = null,
        ?string $expiresAt = null
    ) {
        if ($token) {
            $this->value = $token;
        } else {
            $secret = self::secret();

            $this->value = (new Facade())->issue(
                new Sha256(),
                $secret,
                static fn (
                    Builder $builder,
                    DateTimeImmutable $issuedAt
                ) => $builder
                    ->withClaim($payload_name, $payload)
                    ->expiresAt($issuedAt->modify($expiresAt ?? env('TIME_JWT') ?? '+5 minutes'))
            );
        }
    }

    public static function transform(string $payload_name, UnencryptedToken $token): Token
    {
        return new static(
            $payload_name,
            $token->claims()->get($payload_name),
            $token
        );
    }

    private static function secret()
    {
        return InMemory::plainText(
            env('JWT_SECRET')
        );
    }

    public static function parse(string $token): UnencryptedToken
    {
        $parser = new Parser(new JoseEncoder());
        $token = $parser->parse($token);

        return $token;
    }

    public static function parseForStatic(string $token): self
    {
        $parser = new Parser(new JoseEncoder());
        $unencryptedToken = $parser->parse($token);

        return new self(
            null,
            null,
            $unencryptedToken
        );
    }

    public static function getPayload(string $payload_name, string $token)
    {
        $token = self::parse($token);

        return $token->claims()->get($payload_name);
    }

    public static function validate(JWTToken $token, ?bool $refreshToken= null)
    {
        if($token->isExpired(Carbon::now()))
        {
            throw_if($refreshToken, AuthenticationException::refreshTokenExpired($token->toString()));
            throw AuthenticationException::tokenExpired($token->toString());
        }

        $validator = new Validator();

        return $validator->validate($token, new SignedWith(new Sha256(), self::secret()));
    }

    public static function generate(string $payload_name, mixed $payload, ?string $expiresAt = null)
    {
        return new static($payload_name, $payload, null, $expiresAt);
    }

    public function getExpiration(): DateTimeInterface
    {
        return $this->value->claims()->get('exp');
    }

    public function getType(): string
    {
        return 'Bearer';
    }

    public function toString(): string
    {
        return $this->value->toString();
    }
}
