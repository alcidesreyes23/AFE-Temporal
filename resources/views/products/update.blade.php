@extends('layouts.app')

@section('buttons')
    <a href="{{ route('product.index') }}" class="btn btn-primary mr-2">Regresar</a>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">Agregar Producto</div>
        <div class="card-body">
            <div class="col-md-10 mx-auto bg-white p-3">
                @component('components.alerts')
                @endcomponent
                <form method="POST" action="{{ route('product.update', ['product' => $product, 'op' => $param]) }}"
                    novalidate enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="col-md-12 mb-3">
                                <label for="">Proveedor</label>
                                <select name="supplier_id" id="supplier_id" class="form-control"
                                    value="{{ old('supplier_id') }}">
                                    <option value="">Seleccione proveedor</option>
                                    @foreach ($suppliers as $id => $name)
                                        <option value="{{ $id }}"
                                            {{ $product->supplier_id == $id ? 'selected' : '' }}>
                                            {{ $name }}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Titulo del producto</label>
                                <input type="text" name="product_name" id="product_name" class="form-control"
                                    placeholder="Nombre del producto" value="{{ $product->product_name }}">
                                @error('product_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Precio</label>
                                <input type="text" name="price" id="price" class="form-control" placeholder="Precio"
                                    value="{{ $product->price }}">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Código de Barrra</label>
                                <input type="text" name="barcode" id="barcode" class="form-control"
                                    placeholder="Código de Barra" value="{{ $product->barcode }}">
                                @error('barcode')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3 align-items-center">
                                <label for="">Seleccione una imagen</label>
                                <input type="file" name="image" id="p_image" class="form-control"
                                    placeholder="Seleccione una imagen" />
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <label for="">Imagen actual del producto</label>
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-75 img-thumbnail"
                                alt="{{ $product->product_name }}">
                            <br /><br />
                            <div id="newImage" hidden>
                                <label for="img_product">Nueva imagen del producto</label>
                                <img id="img_product" src="#" class="w-75 img-thumbnail"
                                    alt="{{ $product->product_name }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <a href="{{ $param ? route('product.show', $product) : route('product.index') }}"
                            class="btn btn-danger mr-5">Atrás</a>
                        <input type="submit" class="btn btn-primary" value="Actualizar producto">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="application/javascript">
        $(document).ready(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("#newImage").removeAttr('hidden');
                        $('#img_product').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#p_image").change(function() {
                readURL(this);
            });
        })
    </script>
@endsection
