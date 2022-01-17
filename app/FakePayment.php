<?php

namespace App;
use App\Contracts\PaymentContract;

class FakePayment implements PaymentContract
{
    public function getTestToken(){
        return 'valid-token';
    }

    public function totalCharged()
    {

    }

	function charge($total, $token) {
	}
}
