<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getOrdersAdmin(){
        $orders = Order::whereNotNull('is_admin')->paginate(10);
        return view('orders.admin', compact('orders'));
    }

    public function getOrderAdmin($id){
        $order = Order::findOrFail($id);
        return view('orders.admin-details', compact('order'));
    }

    public function getOrders(){
        $orders = Order::where('provider_id', auth()->user()->id)->whereNull('is_admin')->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function getOrder($id){
        $order = Order::findOrFail($id);
        return view('orders.order-details', compact('order'));
    }

    public function accept_order($id){
        $order = Order::findOrFail($id);
        $order->status = 1;
        $order->update();
        return redirect()->back();
    }
    public function reject_order($id){
        $order = Order::findOrFail($id);
        $order->status = 2;
        $order->update();
        return redirect()->back();
    }
    public function done_order($id){
        $order = Order::findOrFail($id);
        $order->status = 4;
        $order->update();
        return redirect()->back();
    }
}
