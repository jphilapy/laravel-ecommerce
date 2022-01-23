<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Contracts\PaymentContract;
use App\FakePayment;
use App\Cart;
use Stripe\StripeClient;

class OrdersController extends Controller
{

    private $payment;

    public function __construct(PaymentContract $payment){
        $this->payment = $payment;
    }

    public function store() {
        $cart = new Cart();



        $stripe = new StripeClient(
            env('STRIPE_SECRET')
        );

        $customer = $stripe->customers->create([
            'email' => 'jeff@altahost.com',
            'source' => request('stripeToken')
        ]);

        $this->payment->charge($cart->total(), request('stripeToken'), $customer);

        $order = Order::create([
            'email'=>request('stripeEmail'),
            'total'=> $this->payment->total(),
        ]);

        $order->addProducts($cart->items);
    }
}
