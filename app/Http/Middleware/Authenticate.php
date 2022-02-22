<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Auth\Factory as FactoryAuth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JwtToken;
use Closure;
use Illuminate\Support\Facades\Auth;

//use Laravel\Sanctum\Guard;

class Authenticate extends Middleware
{
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

            $this->guard->setUser($user);
            $this->authenticate($request, $guards);
        }
        catch (ModelNotFoundException $e){
            return new JsonResponse([
                'success' => 0,
                'data'    => [],
                'error'   => 'Invalid Token',
                'errors'  => [],
                'extra'   => []
            ], 422);
        }

        return $next($request);
    }

    /**
     * Handle an unauthenticated user.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws AuthenticationException
     */
    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException(
            'Unauthenticated.', $guards
        );
    }

}
