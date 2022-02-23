<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     title="Petshop API",
 *     description="Implementation of the Petshop API",
 *     version="1.0",
 *     @OA\Contact(
 *          email="loisbassey@gmail.com"
 *     ),
 * ),
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Demo API Server"
 * )
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
