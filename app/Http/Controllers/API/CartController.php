<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;

class CartController extends Controller
{   use ApiTrait;
    //
    public function store(Request $request)
    {
        $product = Product::find($request->product_id);
//        if ($request->discount == null){
//            $p_price = $product->price * $request->quantity;
//        }else{
//            $p_price = ($product->price * $request->quantity) - $request->discount;
//        }
        $cart = Cart::create([
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
            'provider_id' => $request->provider_id,
            'quantity' => $request->quantity,
            'discount' => $request->discount,
            'total_amount' => null,
            'name' => $product->name,
            'is_coupon' => $product->is_coupon,
            'description' => $product->description,
            'price' => $product->price,
            'image' => $product->image,
            'service_id' => $product->service_id,
            'category_id' => $product->category_id,
        ]);

        if ($cart){
            return $this->apiData($cart, 200, 'Cart');
        }
    }

    public function getCart($id){
        $cart = Cart::where('user_id', $id)->get();
        if ($cart){
            return $this->apiData($cart, 200, 'Cart');
        }
    }


    public function destroy($id){
        $cart = Cart::find($id);
        $cart->delete();
        $msg= 'product deleted successfully';
        if(request()->is('api/*')){
            return comman_custom_response(['message'=> $msg , 'status' => true]);
        }
    }
}
