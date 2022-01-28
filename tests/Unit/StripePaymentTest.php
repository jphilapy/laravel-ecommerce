<?php

namespace Tests\Unit;

use App\FakePayment;
use App\StripePayment;
use PHPUnit\Framework\TestCase;
use Stripe\StripeClient;


class StripePaymentTest extends TestCase
{
    /**
     * @test
     * This code does not match video 14 because his way is out of date with the latest Stripe
     */
    public function it_can_make_real_charges_with_a_valid_token()
    {
        $payment = new StripePayment();

        $stripe = new StripeClient(
            env('STRIPE_SECRET')
        );

        $token = $stripe->tokens->create([
            'card' => [
                'number' => '4242424242424242',
                'exp_month' => 1,
                'exp_year' => date('Y')+1,
                'cvc' => '123'
            ],
        ]);

        $customer = $stripe->customers->create([
            'email' => 'jeff@altahost.com',
            'source' => $token->id
        ]);

        $payment->charge(1000, $token->id, $customer);

        $this->assertEquals(1000, $payment->total());
    }

}
