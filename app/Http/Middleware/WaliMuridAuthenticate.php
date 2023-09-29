<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class WaliMuridAuthenticate extends Authenticate
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login.waliMurid');
    }
}
