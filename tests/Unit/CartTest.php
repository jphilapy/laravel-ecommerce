<?php

namespace Tests\Unit;

use App\Cart;
use App\Product;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_can_add_items_to_the_cart()
    {
        $product = factory(Product::class)->create();
        $cart = new Cart();

        $cart->add($product, $product->id);

        $this->assertEquals(1, $cart->items->count());
    }

    /**
     * @test
     */
    public function it_has_a_total_price()
    {
        $products = factory(Product::class, 3)->create([
            'price' => 1000
        ]);
        $cart = new Cart();

        foreach($products as $product) {
            $cart->add($product, $product->id);
        }

        $this->assertEquals('30.00', $cart->totalPrice());
    }
}
