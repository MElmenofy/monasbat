<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Service;
//use Dotenv\Validator;
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

    public function storeProduct(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'provider_id' => 'required',
            'image' => 'required',
            'service_id' => 'required',
            'status' => 'required',
            'is_coupon' => 'required',
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->provider_id = $request->provider_id;
        $product->category_id = $request->category_id;
        $product->service_id = $request->service_id;
        $product->status = $request->status;
        $product->is_coupon = $request->is_coupon;
        // single image
        $imageName = time().'.'.$request->image->extension();
        $product->image = $imageName;
        $request->image->move(public_path('/uploads/products/'), $imageName);
        // /single image

//        multi image
//        $files = [];
//        if ($request->hasFile('image')) {
//            foreach ($request->file('image') as $file){
//                $name = time().rand(1,1000).'.'.$file->getClientOriginalName();
//                $file->move(public_path() . '/uploads/products/', $name);
//                $files[] = $name;
//                $string = implode(',', $files);
//            }
//        }
//        $product->image = $string;
//        if ($request->hasfile('image')) {
//            foreach ($request->file('image') as $file) {
//                $name = time() . rand(1,1000) . $file->extension();
//                $file->move(public_path() . '/uploads/products/', $name);
//                $data[] = $name;
//            }
//        }
//        $product->image = json_encode($data);
//        multi image
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
            'image' => 'required',
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

        if($request->image != '') {
            $path = public_path('/uploads/products/');
            if ($product->image != '' && $product->image != null) {
                $file_old = $path . $product->image;
                unlink($file_old);
            }
            // single image
            $imageName = time() . '.' . $request->image->extension();
            $product->image = $imageName;
            $request->image->move(public_path('/uploads/products/'), $imageName);
            // /single image
        }
        // /single image
        $product->save();
//        if ($validated->fails()) {
//            return $this->apiData(null, 400, $validated->errors());
//        }
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
