<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Cart;
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

        foreach ($cart as $item) {
            $provider = User::findOrFail($item->provider_id);
            $order = Order::create([
                'user_id' => $request->user_id,
                'address' => $request->address,
                'arrival_time' => $request->arrival_time,
                'payment_type' => $request->payment_type,
                'total_amount' => $request->total_amount, // after all operation
                'provider_name' => $provider->first_name . ' ' .$provider->last_name,
                'user_name' => $user->first_name . ' ' .$user->last_name,
                'user_phone' => $user->contact_number,
                'provider_id' => $item->provider_id,
                'product_name' => $item->name,
                'product_description' => $item->description,
                'product_price' => $item->price,
                'product_image' => $item->image,
                'quantity' => $item->quantity,
//                'discount' => 0,
                 'discount' => $item->discount,
                'status' => 0,
            ]);
            if($item) {
                $cart->where('id', $item->id)->first()->delete();
            }
        }
        if ($order){
            return $this->apiData($order, 200, 'Order');
        }
    }

    public function getOrders($id){
        $orders = Order::where('provider_id', $id)->get();

        if ($orders){
            return $this->apiData($orders, 200, 'Order');
        }else{
            return $this->apiData(null, 200, 'Orders Not Found');
        }

    }

    public function getUserOrders($id){
        $orders = Order::where('user_id', $id)->get();

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
    public function reject_order($id){
        $order = Order::findOrFail($id);
        $order->status = 2;
        $order->update();
        return $this->apiData($order, 200, 'Order');
    }
    public function cancel_order($id){
        $order = Order::findOrFail($id);
        $order->status = 3;
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
