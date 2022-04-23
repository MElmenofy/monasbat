<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{

    public function index()
    {
        $shippings = Shipping::paginate(10);
        return view('shipping.index', compact('shippings'));
    }

    public function create()
    {
        return view('shipping.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'city' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
        ]);
        $shipping = new Shipping();
        $shipping->city = $request->city;
        $shipping->price = $request->price;
        $shipping->status = $request->status;
        $shipping->save();
        return redirect()->route('shippings.index')->with('success', 'Shipping created successfully');
    }

    public function edit(Shipping $shipping){
        return view('shipping.edit', compact('shipping'));
    }

    public function update(Request $request, Shipping $shipping){
        $validated = $request->validate([
            'city' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
        ]);
        $shipping->city = $request->city;
        $shipping->price = $request->price;
        $shipping->status = $request->status;
        $shipping->save();
        return redirect()->route('shippings.index')->with('success', 'Shipping updated successfully');
    }

    public function destroy(Shipping $shipping){
        $shipping->delete();
        return redirect()->route('shippings.index')->with('success', 'Shipping Deleted successfully');
    }
}
