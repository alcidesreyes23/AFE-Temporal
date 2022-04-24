<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{

    protected array $rules = [
        'product_name' => ['required', 'min:5', 'max:50'],
        'price' => ['required','numeric'],
        'barcode' => ['required', 'min:5', 'max:8'],
        'image' => ['required', 'image','mimes:jpg,png','max:1024'],
        'supplier_id' => 'required'
    ];

    protected array $customAttributes = [
        'product_name' => 'Nombre de producto',
        'price' => 'Precio',
        'barcode' => 'Código de barras',
        'image' => 'Imagen',
        'supplier_id' => 'Proveedor',
    ];

    public function index()
    {
        $products = auth()->user()->products;
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $suppliers = Supplier::all()->pluck('supplier_name', 'id');
        return view('products.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        try {
            $values = $this->validate($request,$this->rules, [], $this->customAttributes);
            $values['image'] = $request['image']->store('products-images', 'public');
            $img = Image::make(public_path("storage/{$values['image']}"))->fit(1000, 550);
            $img->save();
            auth()->user()->products()->create($values);
            session()->flash('success', 'Producto agregado exitosamente');
            return redirect()->route('product.index');
        } catch (\Illuminate\Validation\ValidationException $ve) {
            session()->flash('error', 'Verifique que todos los campos hayan sido completados, por favor.');
            $this->validate($request,$this->rules, [], $this->customAttributes);
        }
        catch (\Throwable $th) {
            session()->flash('error', 'Parece que hubo un error, intentelo más tarde.');
            return redirect()->back();
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();
        session()->flash('success', 'Producto eliminado exitosamente');
        return redirect()->route('product.index');
    }
}
