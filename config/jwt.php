<?php

return [

//    'public_key' => storage_path(env('JWT_PUBLIC_KEY')),
    'private_key' => __DIR__ . '/../storage/jwt/jwtRS256.pem',
    'public_key' => __DIR__ . '/../storage/jwt/jwtRS256.pem.pub',

];
