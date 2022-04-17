<?php

namespace App\Http\Controllers;

use App\Models\CouponProduct;
use Illuminate\Http\Request;

class CouponProductController extends Controller
{
    //
    public function index(){
        $coupons = CouponProduct::where('provider_id', auth()->user()->id)->get();
        return view('product-coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('product-coupons.create');
    }

    public function storeCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons',
            'price' => 'required|numeric',
//            'provider_id' => 'required',
            'type' => 'required',
            'used_count' => 'required'
        ]);
        $coupon = new CouponProduct();
        $coupon->code = $request->code;
        $coupon->price = $request->price;
        $coupon->provider_id = auth()->user()->id;
        $coupon->type = $request->type;
        $coupon->used_count = $request->used_count;
        $coupon->save();
        return redirect()->route('product_coupons')->with('success', 'coupon created successfully');
    }

    public function edit($id)
    {
        $coupon = CouponProduct::where('id', $id)->firstOrFail();
        return view('product-coupons.update', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|unique:coupons',
            'price' => 'required|numeric',
//            'provider_id' => 'required',
            'type' => 'required',
            'used_count' => 'required'
        ]);
        $coupon = CouponProduct::where('id', $id)->firstOrFail();
        $coupon->code = $request->code;
        $coupon->price = $request->price;
        $coupon->type = $request->type;
        $coupon->used_count = $request->used_count;
        $coupon->update();
        return redirect()->route('product_coupons')->with('success', 'coupon updated successfully');
    }

    public function destroy($id){
        $coupon = CouponProduct::where('id', $id)->firstOrFail();
        $coupon->delete();
        return redirect()->back();
    }
}
