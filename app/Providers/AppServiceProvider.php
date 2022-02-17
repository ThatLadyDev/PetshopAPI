<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer;
use Lcobucci\JWT\Signer\Key\InMemory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Configuration::class, function(){
            return Configuration::forAsymmetricSigner(
                // You may use RSA or ECDSA and all their variations (256, 384, and 512) and EdDSA over Curve25519
                new Signer\Rsa\Sha256(),
                InMemory::file(config('jwt.private_key')),
                InMemory::base64Encoded(config('jwt.public_key'))
            );
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
