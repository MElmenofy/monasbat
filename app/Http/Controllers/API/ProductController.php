<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Service;
//use Dotenv\Validator;
use App\Models\TaxProduct;
use App\Traits\ApiTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use ApiTrait;
    public function index(){
        $products = Service::with('products')->get();
        return response($products, 200, ['done']);
    }

    public function storeProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'provider_id' => 'required',
            'service_id' => 'required',
            'status' => 'required',
            'is_coupon' => 'required',
        ]);
        // $tax = TaxProduct::findOrFail(1);
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->provider_id = $request->provider_id;
        $product->category_id = $request->category_id;
        $product->service_id = $request->service_id;
        $product->status = $request->status;
        $product->is_coupon = $request->is_coupon;
//        $product->tax = $tax->value;
        $product->tax = null;
        // /image one
        $imageName = time() . rand(1, 1000) . '.' . $request->image_one->extension();
        $product->image_one = $imageName;
        $request->image_one->move(public_path('/uploads/products/'), $imageName);
        // /image one
        // /image two
        if ($request->image_two) {
            $imageName = time() . rand(1, 1000) . '.' . $request->image_two->extension();
            $product->image_two = $imageName;
            $request->image_two->move(public_path('/uploads/products/'), $imageName);
        } else {
            $product->image_two = null;
        }
        // /image two
        // /image three
        if ($request->image_three) {
            $imageName = time() . rand(1, 1000) . '.' . $request->image_three->extension();
            $product->image_three = $imageName;
            $request->image_three->move(public_path('/uploads/products/'), $imageName);
        } else {
            $product->image_three = null;
        }
        // /image three
        // image four
        if ($request->image_four) {
            $imageName = time() . rand(1, 1000) . '.' . $request->image_four->extension();
            $product->image_four = $imageName;
            $request->image_four->move(public_path('/uploads/products/'), $imageName);
        } else {
            $product->image_four = null;
        }
        // /image four
        // image five
        if ($request->image_five) {
            $imageName = time() . rand(1, 1000) . '.' . $request->image_five->extension();
            $product->image_five = $imageName;
            $request->image_five->move(public_path('/uploads/products/'), $imageName);
        }else{
            $product->image_five = null;
        }

        // /image five

        $product->save();
        if ($validator->fails()) {
            return $this->apiData(null, 400, $validator->errors());
        }

        if ($product){
            return $this->apiData($product, 200, 'product created');
        }
    }

    public function updateProduct(Request $request, $id){
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'provider_id' => 'required',
            'service_id' => 'required',
            'status' => 'required',
            'is_coupon' => 'required',
        ]);
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->service_id = $request->service_id;
        $product->status = $request->status;
        $product->is_coupon = $request->is_coupon;

        if($request->image_one != '' || $request->image_two != '' || $request->image_three != '' || $request->image_four != ''
            || $request->image_five != '') {
            $path = public_path('/uploads/products/');

            if ($product->image_one != '' && $product->image_one != null) {
                $file_old = $path . $product->image_one;
                unlink($file_old);
            }
            if ($product->image_two != '' && $product->image_two != null) {
                $file_old = $path . $product->image_two;
                unlink($file_old);
            }
            if ($product->iimage_three!= '' && $product->image_three != null) {
                $file_old = $path . $product->image_three;
                unlink($file_old);
            }
            if ($product->image_four != '' && $product->image_four != null) {
                $file_old = $path . $product->image_four;
                unlink($file_old);
            }
            if ($product->image_five != '' && $product->image_five != null) {
                $file_old = $path . $product->image_five;
                unlink($file_old);
            }
            // image one
            if ($request->image_one) {
                $imageName = time() . rand(1, 1000) . '.' . $request->image_one->extension();
                $product->image_one = $imageName;
                $request->image_one->move(public_path('/uploads/products/'), $imageName);
            }
            // /image one
            // /image two
            if ($request->image_two) {
                $imageName = time() . rand(1, 1000) . '.' . $request->image_two->extension();
                $product->image_two = $imageName;
                $request->image_two->move(public_path('/uploads/products/'), $imageName);
            } else {
                $product->image_two = null;
            }
            // /image two
            // /image three
            if ($request->image_three) {
                $imageName = time() . rand(1, 1000) . '.' . $request->image_three->extension();
                $product->image_three = $imageName;
                $request->image_three->move(public_path('/uploads/products/'), $imageName);
            } else {
                $product->image_three = null;
            }
            // /image three
            // image four
            if ($request->image_four) {
                $imageName = time() . rand(1, 1000) . '.' . $request->image_four->extension();
                $product->image_four = $imageName;
                $request->image_four->move(public_path('/uploads/products/'), $imageName);
            } else {
                $product->image_four = null;
            }
            // /image four
            // image five
            if ($request->image_five) {
                $imageName = time() . rand(1, 1000) . '.' . $request->image_five->extension();
                $product->image_five = $imageName;
                $request->image_five->move(public_path('/uploads/products/'), $imageName);
            }else{
                $product->image_five = null;
            }
            // /image five

        }
        $product->save();
        if ($product){
            return $this->apiData($product, 200, 'product updated successfully');
        }
    }


    public function destroy($id){
        $product = Product::find($id);
        $product->delete();
        $msg= 'product deleted successfully';
        if(request()->is('api/*')){
            return comman_custom_response(['message'=> $msg , 'status' => true]);
        }
    }
}
