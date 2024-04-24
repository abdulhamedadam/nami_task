<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
       // return $request->expectsJson() ? null : route('login');

        if (!$request->expectsJson()) {
            if ((new \Illuminate\Http\Request)->is(app()->getLocale() . '/admin/dashboard')) {
                return route('admin.login'); // Redirect to the login route for web guard
            }
            elseif((new \Illuminate\Http\Request)->is(app()->getLocale() . '/api')) {
                return $this->responseApiError('not login', 405);
            }
            else {
                return route('admin.login'); // Redirect to the login route for web guard
            }
        }
    }
}
