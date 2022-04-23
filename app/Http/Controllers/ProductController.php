<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;

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
        $product->price = $request->precio;
        $product->barcode = $request->codigo_barra;
        $product->user_id = Auth::user()->id;
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
