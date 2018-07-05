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
        '/*',
        'paypal/feedback',
        'pagseguro/feedback',
        'http://localhost:8080',
        'https://www.sandbox.paypal.com',
        'https://sandbox.pagseguro.uol.com.br'
    ];
}
