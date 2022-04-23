<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::with('service')->where('provider_id', auth()->user()->id)->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $services = Service::get(['id', 'name']);
        return view('products.create', compact('services'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required',
            'service_id' => 'required',
            'status' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->provider_id = auth()->user()->id;
//        $product->category_id = $request->category_id;
        $product->service_id = $request->service_id;
        $product->status = $request->status;
        $product->is_coupon = $request->is_coupon ? true : false;
        $product->tax = null;

        // single image
//        $imageName = time().'.'.$request->image->extension();
//        $product->image = $imageName;
//        $request->image->move(public_path('/uploads/products/'), $imageName);
        // /single image

//        multi image
        $data = [];
        if ($request->hasFile('image')) {
            $images = $request->file('image');
            foreach ($images as $image) {
                $name=time() . rand(1,1000) .'.'. $image->extension();
                $image->move(public_path().'/uploads/products/', $name);
                $data[] = $name;
            }
            if ($data[0]){
                $product->image_one = $data[0];
            }
            if (!empty($data[1])){
                $product->image_two = $data[1];
            }else{
                $product->image_two = null;
            }
            if (!empty($data[2])){
                $product->image_three = $data[2];
            }else{
                $product->image_three = null;
            }
            if (!empty($data[3])){
                $product->image_four = $data[3];
            }else{
                $product->image_four = null;
            }
            if (!empty($data[4])){
                $product->image_five = $data[4];
            }else{
                $product->image_five = null;
            }
        }
        //        /multi image
        $product->save();
        return redirect()->route('products.index')->with('success', 'product created successfully');
    }

    public function edit(Product $product){
        $services = Service::get(['id', 'name']);
        return view('products.edit', compact('product', 'services'));
    }

    public function update(Request $request, Product $product){
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
//            'image' => 'required',
            'service_id' => 'required',
            'status' => 'required',
        ]);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->service_id = $request->service_id;
        $product->status = $request->status;
        $product->is_coupon = $request->is_coupon ? true : false;
            // delete multi file
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
            if ($product->iimage_three != '' && $product->image_three != null) {
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
        }
            // delete single image

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
        }
        // /image two
        // /image three
        if ($request->image_three) {
            $imageName = time() . rand(1, 1000) . '.' . $request->image_three->extension();
            $product->image_three = $imageName;
            $request->image_three->move(public_path('/uploads/products/'), $imageName);
        }
        // /image three
        // image four
        if ($request->image_four) {
            $imageName = time() . rand(1, 1000) . '.' . $request->image_four->extension();
            $product->image_four = $imageName;
            $request->image_four->move(public_path('/uploads/products/'), $imageName);
        }
        // /image four
        // image five
        if ($request->image_five) {
            $imageName = time() . rand(1, 1000) . '.' . $request->image_five->extension();
            $product->image_five = $imageName;
            $request->image_five->move(public_path('/uploads/products/'), $imageName);
        }
        // /image five
        $product->save();
        return redirect()->route('products.index')->with('success', 'product updated successfully');
    }

    public function destroy(Product $product){
        $image_path = public_path("uploads/products/$product->image");  // Value is not URL but directory file path
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'product Deleted successfully');
    }
}
