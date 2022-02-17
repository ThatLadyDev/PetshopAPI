<?php

namespace App\Services;

use Lcobucci\JWT\Configuration;
use Illuminate\Container\Container;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use DateTimeImmutable;

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
    public function issueToken()
    {
        $config = $this->container->get(Configuration::class);
        assert($config instanceof Configuration);

        $now   = new DateTimeImmutable();
        $token = $config->builder()
            // Configures the issuer (iss claim)
            ->issuedBy(config('app.url'))
            // Configures a new claim, called "uid"
            ->withClaim('uid', 1)
            // Configures a new header, called "foo"
            ->withHeader('product_type', 'buckhill-petshop-api-899384')
            // Builds a new token
            ->getToken($config->signer(), $config->signingKey());

        return $token;
    }

}
