<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CouponProduct;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
class OrderController extends Controller
{   use ApiTrait;
    public function createOrder(Request $request)
    {
        $cart = Cart::where('user_id', $request->user_id)->get();
        $user = User::findOrFail($request->user_id);
        if ($request->coupon_id){
        $coupon = CouponProduct::find($request->coupon_id);
        $coupon->decrement('used_count', 1);
        }
        $data = [];
        $o_provider = [];
        $quantity = [];
        foreach ($cart as $item) {
            $provider = User::findOrFail($item->provider_id);
            $name = $item->id;
            $data[] = $name;

            $o_provider = $item->provider_id;
            $o_provider_a[] = $o_provider;

            $q = $item->quantity;
            $quantity_a[] =$q;
            $orders = Order::create([
                'user_id' => $request->user_id,
                'address' => $request->address,
                'arrival_time' => $request->arrival_time,
                'payment_type' => $request->payment_type,
                'shipping_name' => $request->shipping_name,
                'shipping_cost' => $request->shipping_cost,
                'coupon_id' => $request->coupon_id,
                'discount' => $request->discount,
                'total_amount' => $request->total_amount,
//                'comment' => $request->comment,
                'all_cost_after_discount_and_shipping' => $request->allCostAfterDiscountAndShipping, // after all operation
                'provider_name' => $provider->first_name . ' ' .$provider->last_name,
                'user_name' => $user->first_name . ' ' .$user->last_name,
                'user_phone' => $user->contact_number,
                'provider_id' => $item->provider_id,
                'product_name' => $item->name,
                'product_description' => $item->description,
                'product_price' => $item->price,
                'product_image' => $item->image,
                'quantity' => $item->quantity,
                'product_tax' => $item->tax,
                'status' => 0,
            ]);
        }
        // list product
        $order = new Order();
        $order->user_id = $request->user_id;
        $order->address = $request->address;
        $order->arrival_time = $request->arrival_time;
        $order->payment_type = $request->payment_type;
        $order->shipping_name = $request->shipping_name;
        $order->shipping_cost = $request->shipping_cost;
        $order->coupon_id = $request->coupon_id;
        $order->discount = $request->discount;
        $order->total_amount = $request->total_amount;
        $order->all_cost_after_discount_and_shipping = $request->allCostAfterDiscountAndShipping; // after all operation
        $order->provider_name = $provider->first_name . ' ' .$provider->last_name;
        $order->user_name = $user->first_name . ' ' .$user->last_name;
        $order->user_phone = $user->contact_number;
        $order->provider_id = $cart[0]['provider_id'];
        // $order->product_name = $data;
        $order->quantity = $cart[0]['quantity'];
        $order->product_name =  json_encode($cart, true);;
        $order->product_description = null;
        $order->product_price = null;
        $order->product_image = null;
        $order->product_tax = null;
        $order->status = 0;
        $order->is_admin = 1;
        $order->save();
        if($item) {
            foreach ($data as $d)
            $cart->where('id', $d)->first()->delete();
        }
        if ($order){
            return $this->apiData($order, 'تم حجز المنتجات بنجاح', 200);
        }
    }

    public function getOrders($id){
        $orders = Order::where('provider_id', $id)->whereNull('is_admin')->get();
        if ($orders){
            return $this->apiData($orders, 200, 'Order');
        }else{
            return $this->apiData(null, 200, 'Orders Not Found');
        }
    }

    public function getUserOrders($id){
        $orders = Order::where('user_id', $id)->whereNull('is_admin')->get();

        if ($orders){
            return $this->apiData($orders, 200, 'Order');
        }else{
            return $this->apiData(null, 200, 'Orders Not Found');
        }
    }

    public function accept_order($id){
        $order = Order::findOrFail($id);
        $order->status = 1;
        $order->update();
        return $this->apiData($order, 200, 'Order');
    }
    public function reject_order(Request $request){
        $order = Order::findOrFail($request->id);
        $order->status = 2;
        $order->comment = $request->comment;
        $order->update();
        return $this->apiData($order, 200, 'Order');
    }
    public function cancel_order(Request $request){
        $order = Order::findOrFail($request->id);
        $order->status = 3;
        $order->comment = $request->comment;
        $order->update();
        return $this->apiData($order, 200, 'Order');
    }

    public function done_order($id){
        $order = Order::findOrFail($id);
        $order->status = 4;
        $order->update();
        return $this->apiData($order, 200, 'Order');
    }
}
