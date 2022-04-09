<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index',compact('products'));
    }

    public function create()
    {
        $suppliers = Supplier::all()->pluck('supplier_name','id');
        return view('products.create',compact('suppliers'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'product_name' => 'required',
        ],[],['product_name' => 'Nombre del producto']);
        //dd($request->all());


        $product = new Product();
        $product->product_name = $request->product_name;
        $product->price = 8.50;
        $product->barcode = 12658988;
        $product->user_id = 1;
        $product->supplier_id = $request->supplier_id;

        $product->save();

        // Product::create($request->all());
        session()->flash('success','Producto agregado exitosamente');
        return redirect()->route('product.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        session()->flash('success','Producto eliminado exitosamente');
        return redirect()->route('product.index');
    }
}
