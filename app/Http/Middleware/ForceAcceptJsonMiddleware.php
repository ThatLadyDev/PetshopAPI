<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ForceAcceptJsonMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|JsonResponse|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|JsonResponse|RedirectResponse
    {
        $request->headers->set('Accept', 'application/json');
        return $next($request);
    }
}
