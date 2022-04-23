<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    use ApiTrait;
    public function getShipping()
    {
        $shipping = Shipping::whereNotNull('price')->where('status', 1)->get();

        if ($shipping){
            return $this->apiData($shipping, 200, 'Shipping');
        }
    }
}
