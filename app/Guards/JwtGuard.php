<?php

namespace App\Guards;

use Illuminate\Auth\Events\Logout;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;
use JsonException;

class JwtGuard implements Guard
{

    /**
     * The name of the guard.
     *
     * Corresponds to guard name in authentication configuration.
     *
     * @var string
     */
    protected $name;

    /**
     * @var mixed
     */
    protected $request;

    /**
     * @var mixed
     */
    protected $provider;

    /**
     * @var mixed
     */
    protected $user;

    /**
     * The event dispatcher instance.
     *
     * @var Dispatcher
     */
    protected $events;

    /**
     * Indicates if the logout method has been called.
     *
     * @var bool
     */
    protected $loggedOut = false;

    /**
     * Create a new authentication guard.
     *
     * @param UserProvider $provider
     * @param Request $request
     * @return void
     */
    public function __construct(UserProvider $provider, Request $request)
    {
        $this->request  = $request;
        $this->provider = $provider;
        $this->name     = 'api';
    }

    /**
     * Determine if the current user is a guest.
     *
     * @return bool
     */
    public function guest() : bool
    {
        return ! $this->check();
    }

    /**
     * Determine if the guard has a user instance.
     *
     * @return bool
     */
    public function hasUser() : bool
    {
        return ! is_null($this->user);
    }

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return string|null
     */
    public function id() : string|null
    {
        if ($user = $this->user()) {
            // @phpstan-ignore-next-line
            return $this->user()->getAuthIdentifier();
        }

        return null;
    }

    /**
     * Set the current user.
     *
     * @param  Authenticatable $user User info
     * @return void
     */
    public function setUser(Authenticatable $user) : void
    {
        $this->user = $user;
    }

    /**
     * Get the JSON params from the current request
     *
     * @return string|null
     * @throws JsonException
     */
    public function getJsonParams(): ?string
    {
        $jsondata = $this->request->query('jsondata');

        return (!empty($jsondata) ? json_decode($jsondata, TRUE, 512, JSON_THROW_ON_ERROR) : NULL);
    }

    public function validate(array $credentials = [] ) : bool
    {
        if (empty($credentials['email']) || empty($credentials['password'])) {
            if (!$credentials=$this->getJsonParams()) {
                return false;
            }
        }

        $user = $this->provider->retrieveByCredentials($credentials);

        if (! is_null($user) && $this->provider->validateCredentials($user, $credentials)) {
            $this->setUser($user);

            return true;
        }

        return false;
    }

    /**
     * Log the user out of the application.
     *
     * @return void
     */
    public function logout() : void
    {
        $user = $this->user();

        // If we have an event dispatcher instance, we can fire off the logout event
        // so any further processing can be done. This allows the developer to be
        // listening for anytime a user signs out of this application manually.
        // @phpstan-ignore-next-line
        if (isset($this->events)) {
            // @phpstan-ignore-next-line
            $this->events->dispatch(new Logout($this->name, $user));
        }

        // Once we have fired the logout event we will clear the users out of memory
        // so they are no longer available as the user is no longer considered as
        // being signed into this application and should not be available here.
        $this->user = null;
        $this->loggedOut = true;
    }

    public function user()
    {
        return $this->user ?? null;
    }

    public function check(): bool
    {
        return isset($this->user);
    }

    public function is_admin() : bool
    {
        return $this->user->is_admin === true;
    }
}
