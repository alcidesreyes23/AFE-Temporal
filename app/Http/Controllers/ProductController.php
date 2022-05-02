<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    protected function rules($op)
    {
        $array = [
            'product_name' => ['required', 'min:5', 'max:50'],
            'price' => ['required', 'numeric'],
            'barcode' => ['required', 'min:5', 'max:8'],
            'supplier_id' => 'required'
        ];
        $array['image'] =  $op == 1 ?  ['required', 'image', 'mimes:jpg,png', 'max:1024'] : ['nullable', 'image', 'mimes:jpg,png', 'max:1024'];
        return $array;
    }

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
            $values = $this->validate($request, $this->rules(1), [], $this->customAttributes);
            $values['image'] = $this->saveImage($request);
            auth()->user()->products()->create($values);
            session()->flash('success', 'Producto agregado exitosamente');
            return redirect()->route('product.index');
        } catch (\Illuminate\Validation\ValidationException $ve) {
            session()->flash('error', 'Verifique que todos los campos hayan sido completados, por favor.');
            $this->validate($request, $this->rules(1), [], $this->customAttributes);
        } catch (\Throwable $th) {
            session()->flash('error', 'Parece que hubo un error, intentelo más tarde.');
            return redirect()->back();
        }
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $param = request()->op;
        $suppliers = Supplier::all()->pluck('supplier_name', 'id');
        return view('products.update', compact('suppliers', 'product', 'param'));
    }

    public function update(Request $request, Product $product)
    {
        try {
            $values = $this->validate($request, $this->rules(2), [], $this->customAttributes);
            if (array_key_exists('image', $values)) {
                $this->deleteImage($product);
                $values['image'] = $this->saveImage($request);
            }

            $product->update($values);
            session()->flash('success', 'Producto actualizado exitosamente');
            if ($request->op) {
                return redirect()->route("product.show", $product);
            } else {
                return redirect()->route("product.index");
            }
        } catch (\Illuminate\Validation\ValidationException $ve) {
            session()->flash('error', 'Verifique que todos los campos hayan sido completados, por favor.');
            $this->validate($request, $this->rules(2), [], $this->customAttributes);
        } catch (\Throwable $th) {
            session()->flash('error', 'Parece que hubo un error, intentelo más tarde.');
            return redirect()->back();
        }
    }

    protected function saveImage(Request $request): string {
        $image = $request['image']->store('products-images', 'public');
        $img = Image::make(public_path("storage/{$image}"))->fit(1000, 550);
        $img->save();
        return $image;
    }

    protected function deleteImage(Product $product)
    {
        if ($product->image)
            if (File::exists(public_path("storage/{$product->image}")))
                File::delete(public_path("storage/{$product->image}"));
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();
            session()->flash('success', 'Producto eliminado exitosamente');
            return redirect()->route('product.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Parece que hubo un error, intentelo nuevamente.');
            return redirect()->route('product.index');
        }
    }
}
