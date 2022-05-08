<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CouponProduct;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponProductController extends Controller
{
    use ApiTrait;
    //
    public function index($id){
        $coupons = CouponProduct::where('provider_id', $id)->get();
        return $this->apiData($coupons, 200, 'Coupons');
    }

    public function getAll(){
        $coupons = CouponProduct::get();
        return $this->apiData($coupons, 200, 'Coupons');
    }

    public function storeCoupon(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:coupons',
            'price' => 'required',
//            'provider_id' => 'required',
            'type' => 'required',
            'used_count' => 'required'
        ]);
        $coupon = new CouponProduct();
        $coupon->code = $request->code;
        $coupon->price = $request->price;
//        $coupon->provider_id = $request->provider_id;
        $coupon->type = $request->type;
        $coupon->used_count = $request->used_count;
        $coupon->save();
        if ($validator->fails()) {
            return $this->apiData(null, 400, $validator->errors());
        }
        if ($coupon){
            return $this->apiData($coupon, 200, 'Coupon created');
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
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
        if ($coupon){
            return $this->apiData($coupon, 200, 'Coupon Updated Successfully');
        }
    }

    public function destroy($id){
        $coupon = CouponProduct::where('id', $id)->firstOrFail();
        $coupon->delete();
        $msg= 'Coupon deleted successfully';
        if(request()->is('api/*')){
            return comman_custom_response(['message'=> $msg , 'status' => true]);
        }
    }


}
