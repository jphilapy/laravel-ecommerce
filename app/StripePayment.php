<?php

namespace App;

use App\Contracts\PaymentContract;
use Stripe\StripeClient;

class StripePayment implements PaymentContract
{

    public function charge($total, $token)
    {
        $stripe = new StripeClient(
            env('STRIPE_SECRET')
        );

        $stripe->charges->create([
            'amount' => $total,
            'currency' => 'usd',
            'source' => $token,
        ]);
    }
}
