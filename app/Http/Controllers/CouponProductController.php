<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CouponProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class CouponProductController extends Controller
{
    //
    public function index(){
        $coupons = CouponProduct::get();
        return view('product-coupons.index', compact('coupons'));
    }

    public function create()
    {
        $categories = Category::get();
        $products = Product::get();
        return view('product-coupons.create', compact('categories', 'products'));
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
        if (!empty($request->category_id)){
            $cat_id = $request->category_id;
            $cat_id = implode(',', $cat_id);
        }else{
            $cat_id = null;
        }

        if (!empty($request->product_id)){
            $product_id = $request->product_id;
            $product_id = implode(',', $product_id);
        }else{
            $product_id = null;
        }
        $coupon = new CouponProduct();
        $coupon->code = $request->code;
        $coupon->price = $request->price;
        $coupon->type = $request->type;
        $coupon->type_coupon = $request->type_coupon;
        $coupon->category_id = $cat_id;
        $coupon->product_id = $product_id;
        $coupon->used_count = $request->used_count;
        $coupon->save();
        return redirect()->route('product_coupons')->with('success', 'coupon created successfully');
    }

    public function edit($id)
    {
        $categories = Category::get();
        $products = Product::get();
        $coupon = CouponProduct::where('id', $id)->firstOrFail();
        return view('product-coupons.update', compact('coupon', 'categories', 'products'));
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
//        if (!empty($request->category_id)){
//            $cat_id = $request->category_id;
//            $cat_id = implode(',', $cat_id);
//        }else{
//            $cat_id = null;
//        }

//        if (!empty($request->product_id)){
//            $product_id = $request->product_id;
//            $product_id = implode(',', $product_id);
//        }else{
//            $product_id = null;
//        }
        $coupon = CouponProduct::where('id', $id)->firstOrFail();
        $coupon->code = $request->code;
        $coupon->price = $request->price;
        $coupon->type = $request->type;
//        $coupon->type_coupon = $request->type_coupon;
//        $coupon->category_id = $cat_id;
//        $coupon->product_id = $product_id;
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
