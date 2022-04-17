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

        // single image
        $imageName = time().'.'.$request->image->extension();
        $product->image = $imageName;
        $request->image->move(public_path('/uploads/products/'), $imageName);
        // /single image

//        multi image
//        if ($request->hasfile('image')) {
//            foreach ($request->file('image') as $file) {
//                $name = time() . rand(1,1000) . $file->extension();
//                $file->move(public_path() . '/uploads/products/', $name);
//                $data[] = $name;
//            }
//        }
//        $product->image = json_encode($data);
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
        if ($request->hasfile('image')) {
//        $images = json_decode($product->image);
//        foreach($images as $image){
//            $image_path = public_path()."uploads/products/".$image;
//            if(File::exists($image_path)) {
//                unlink(public_path("uploads/products/") . $image);
//            }
//        }
            // /delete multi file
            $image_path = public_path("uploads/products/$product->image");  // Value is not URL but directory file path
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
            // delete single image

            // delete single image
            // single image
            $imageName = time().'.'.$request->image->extension();
            $product->image = $imageName;
            $request->image->move(public_path('/uploads/products/'), $imageName);
            // /single image
            // multi file
//            foreach ($request->file('image') as $file) {
//                $name = time() . rand(1,1000) . $file->extension();
//                $file->move(public_path() . '/uploads/products/', $name);
//                $data[] = $name;
//            }
//            $product->image = json_encode($data);
            // /multi file
        }
//        return $request;
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
