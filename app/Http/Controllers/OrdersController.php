<?php

namespace App\Http\Controllers;

use App\Order;
use App\Contracts\PaymentContract;
use App\Cart;

class OrdersController extends Controller
{

    private $payment;

    public function __construct(PaymentContract $payment){
        $this->payment = $payment;
    }

    public function store() {
        $cart = new Cart();

        $this->payment->charge($cart->total(), request('stripeToken'));

        Order::create([
           'email'=>request('stripeEmail'),
           'total'=> $this->payment->total(),
        ]);
    }
}
