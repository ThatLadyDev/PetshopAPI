<?php

namespace App\Services;

use DateTimeImmutable;
use Illuminate\Container\Container;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Token\Plain;
use Lcobucci\JWT\Validation\Constraint\IssuedBy;
use Lcobucci\JWT\Validation\Constraint\SignedWith;


class JwtService
{
    /**
     * Create a new class instance.
     *
     * @param Container $container
     * @return void
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function issueToken($uuid)
    {
        $config = $this->container->get(Configuration::class);
        assert($config instanceof Configuration);

        $now   = new DateTimeImmutable();
        return $config->builder()
            // Configures the issuer (iss claim)
            ->issuedBy(config('app.url'))
            // Configures a new claim, called "user_uuid"
            ->withClaim('user_uuid', $uuid)
            // Configures a new header, called "product_type"
            ->withHeader('product_type', 'buckhill-petshop-api-899384')
            // Builds a new token
            ->getToken($config->signer(), $config->signingKey());
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function verifyToken($bearerToken) : void
    {
        $config = $this->container->get(Configuration::class);
        assert($config instanceof Configuration);

        $token = $config->parser()->parse($bearerToken);
        assert($token instanceof Plain);

        $config->setValidationConstraints(
            new IssuedBy(config('app.url')),
            new SignedWith($config->signer(), $config->verificationKey())
        );

        $constraints = $config->validationConstraints();
        $config->validator()->assert($token, ...$constraints);

    }
}
