<?php

namespace App\Http\Controllers;

use App\Booking;
use http\Env\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Http\Controllers\WebhookController as CashierController;

class WebhookController extends CashierController {
    /**
     * Handle invoice payment succeeded.
     *
     * @param array $payload
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handleInvoicePaymentSucceeded($payload) {
        return new Response('New Stripe WebhookController test Successfull!!!!!', 200);
    }
}
