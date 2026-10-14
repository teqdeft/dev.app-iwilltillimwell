<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        // Public sign-up for partner landing pages. Sanctum treats localhost:3000
        // and other stateful origins as SPA requests and would otherwise 419.
        'api/register',
    ];
}
