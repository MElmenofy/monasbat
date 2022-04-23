<?php

namespace App\Http\Controllers;

use App\Models\TaxProduct;
use Illuminate\Http\Request;

class TaxProductController extends Controller
{
    public function index()
    {
        $taxes = TaxProduct::paginate(10);
        return view('tax-products.index', compact('taxes'));
    }

    public function create()
    {
        return view('tax-products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'type' => 'required|numeric',
            'value' => 'required',
            'status' => 'required',
        ]);
        $tax = new TaxProduct();
        $tax->title = $request->title;
        $tax->type = $request->type;
        $tax->value = $request->value;
        $tax->status = $request->status;
        $tax->save();
        return redirect()->route('tax_products.index')->with('success', 'Shipping created successfully');
    }

    public function edit(TaxProduct $taxProduct){
        return view('tax-products.edit', compact('taxProduct'));
    }

    public function update(Request $request, TaxProduct $taxProduct){
        $validated = $request->validate([
            'title' => 'required',
            'type' => 'required|numeric',
            'value' => 'required',
            'status' => 'required',
        ]);
        $taxProduct->title = $request->title;
        $taxProduct->type = $request->type;
        $taxProduct->value = $request->value;
        $taxProduct->status = $request->status;
        $taxProduct->save();
        return redirect()->route('tax_products.index')->with('success', 'Tax updated successfully');
    }

    public function destroy(TaxProduct $taxProduct){
        $taxProduct->delete();
        return redirect()->route('tax_products.index')->with('success', 'Tax Deleted successfully');
    }
}
