<?php

namespace App\Http\Middleware;

use Dotenv\Util\Str;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $route = \Illuminate\Support\Str::contains($request->url(), 'admin') ?
            route('login') : route('student-login.form');
        return $request->expectsJson() ? null : $route;
    }
}
