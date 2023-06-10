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
        '/jazzcash/status','/pay-via-ajax', '/success','/cancel','/fail','/ipn','/payment-razor/*','/paytm-response','/liqpay-callback','/paytm-response','/mercadopago/make-payment','/flutterwave-pay'
    ];
}
