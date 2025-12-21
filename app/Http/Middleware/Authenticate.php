<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Handle redirect when user is not authenticated.
     * For API applications, we do NOT redirect to login page.
     */
    protected function redirectTo(Request $request): ?string
    {
        // Disable redirect for API (return JSON instead)
        return null;
    }
}
