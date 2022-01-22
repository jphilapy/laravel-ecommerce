<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Contracts\PaymentContract;
use App\FakePayment;
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

        $order = Order::create([
           'email'=>request('stripeEmail'),
           'total'=> $this->payment->total(),
        ]);

        $order->addProducts($cart->items);
    }
}
