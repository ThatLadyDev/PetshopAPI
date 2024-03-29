<?php

namespace App\Http\Middleware;

use App\Models\JwtToken;
use App\Models\User;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Contracts\Auth\Factory as FactoryAuth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

//use Laravel\Sanctum\Guard;

class Authenticate extends Middleware
{
    public Guard $guard;

    public function __construct(FactoryAuth $auth, Guard $guard)
    {
        parent::__construct($auth);
        $this->guard = $guard;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param string[] ...$guards
     * @return mixed
     *
     */
    public function handle($request, Closure $next, ...$guards): mixed
    {
        try {
            JwtToken::where('unique_id', $request->bearerToken())->firstOrFail();
            $user = User::where('uuid', $request->get('uuid'))->first();

            // @phpstan-ignore-next-line
            $this->guard->setUser($user);
            $this->authenticate($request, $guards);
        } catch (ModelNotFoundException $e) {
            return new JsonResponse([
                'success' => 0,
                'data' => [],
                'error' => 'Invalid Token',
                'errors' => [],
                'extra' => []
            ], 422);
        }

        return $next($request);
    }

    /**
     * Handle an unauthenticated user.
     *
     * @param Request $request
     * @param array $guards
     * @return void
     *
     * @throws AuthenticationException
     */
    protected function unauthenticated($request, array $guards): void
    {
        throw new AuthenticationException(
            'Unauthenticated.', $guards
        );
    }

}
