<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use App\Services\JwtService;
use Lcobucci\JWT\Validation\RequiredConstraintsViolated;
use Illuminate\Http\JsonResponse;

class JwtMiddleware
{

    public function __construct(JwtService $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $this->jwtService->verifyToken($request->bearerToken());
        }
        catch (Exception $e) {
            if ($e instanceof RequiredConstraintsViolated){
                return new JsonResponse(['message' => $e->getMessage()], 401);
            }

            return new JsonResponse(['message' => $e->getMessage()], 401);
        }
        return $next($request);
    }
}
