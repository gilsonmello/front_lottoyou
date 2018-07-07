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
        'getTranslations/en_US',
        'http://spa.lottoyou.bet',
        'paypal/feedback',
        'pagseguro/feedback',
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
        dd($request->getHost());
        if ($request->getHost() == 'http://spa.lottoyou.bet') {
            // skip CSRF check
            return $next($request);
        }

        return parent::handle($request, $next);
    }
}
