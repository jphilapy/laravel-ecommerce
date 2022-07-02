<?php

namespace Tests\Feature;

use App\Cart;
use App\Contracts\PaymentContract;
use App\FakePayment;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function it_can_purchase_products()
    {
        $product = Product::factory()->create([
            'price' => 1000
        ]);
;
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

    /**
     * @test
     */
    public function it_creates_orders_after_purchase() {
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

        $order = Order::where('email', 'test@email.com')->first();

        $this->assertNotNull($order);
    }
}
