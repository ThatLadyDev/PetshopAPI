<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\JwtService;
use Illuminate\Support\Facades\Auth;
use Lcobucci\JWT\Validation\RequiredConstraintsViolated;
use Illuminate\Http\JsonResponse;

class JwtMiddleware
{
    public JwtService $jwtService;

    public function __construct(JwtService $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure(\Illuminate\Http\Request): (\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse)  $next
     * @return JsonResponse|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            if ($request->bearerToken() === null){
                throw new Exception('Authorization Token Required!');
            }
            $token = $this->jwtService->verifyToken($request->bearerToken());
            $request->request->add(['uuid' => $token]);
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
