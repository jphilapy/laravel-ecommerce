<?php

namespace Tests\Feature;

use App\Cart;
use App\Product;
use App\FakePayment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Contracts\PaymentContract;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function it_can_purchase_products()
    {
        $product = factory(Product::class)->create([
            'price' => 1000
        ]);

        $cart = new Cart();
        $cart->add($product, $product->id);

        $payment = new FakePayment();

        $this->app->instance(PaymentContract::class, $payment);

        $this->post('/orders', [
            'stripeEmail' => 'test@email.com',
            'stripeToken' => $payment->getTestToken()
        ]);

        $this->assertEquals('10.00', $payment->totalCharged());

    }
}
