<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/oauth/token',
        '/api/paypal/feedback',
        '/api/pagseguro/feedback',
        'https://www.sandbox.paypal.com',
        'https://sandbox.pagseguro.uol.com.br'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {        
        if ($request->header('origin') == 'http://lottoyou-adm.com' 
            || $request->header('origin') == 'https://www.lottoyou.bet'
            || $request->header('origin') == 'https://lottoyou.bet'
            || $request->header('origin') == 'http://lottoyou.bet') {
            // skip CSRF check
            return $next($request);
        }

        return parent::handle($request, $next);
    }
}
