<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        $products = Product::all();
        return view('products.products', compact(['sections', 'products']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sections|max:255',
            'section_id' => 'required',
        ]);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'section_id' => $request->section_id,

        ]);
        session()->flash('Add', 'Ajouté avec succès');
        return redirect('/products');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sections|max:255',
            'section_id' => 'required',
        ]);
        $product = Product::find($request->id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'section_id' => $request->section_id,

        ]);
        session()->flash('edit','Modification avec succès');
        return redirect('/products');
    }

    public function destroy(Request $request)
    {
        Product::find($request->id)->delete();
        session()->flash('delete','Suppression avec succès');
        return redirect('/products');
    }
}
