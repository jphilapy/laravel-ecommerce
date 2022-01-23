<?php

namespace App;

use App\Contracts\PaymentContract;
use Stripe\StripeClient;

class StripePayment implements PaymentContract
{
    private $total;

    public function charge($total, $token, $customer)
    {
        $stripe = new StripeClient(
            env('STRIPE_SECRET')
        );

        $charge = $stripe->charges->create([
            'amount' => 1000,
            'currency' => 'usd',

            'description' => 'working through tutorial - ' . date('h:i:s'),
            'customer' => $customer->id
        ]);

        $this->total = $charge->amount_captured;
    }

    public function total()
    {
        return $this->total;
    }
}
