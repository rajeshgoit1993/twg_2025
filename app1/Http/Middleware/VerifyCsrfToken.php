<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
         'get-country',
        'get-cities',
        'get-locations',
        'set-country-status',
        'make-payment',
        'bookRooms',
        'booking-confirmation',
        'check_availability',
        'CheckUserAvailblity',
        'ConfirmCancelBooking',
        'cancelBooking',
        'Holidays/*',
        '/paytm-callback*',
        '/phonepe-callback'
    ];
}
