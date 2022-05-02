@extends('layouts.app')

@section('css')
@endsection

@section('buttons')
    <a class="btn btn-primary mr-2" href="{{ route('product.index') }}">Regresar</a>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">Detalles del producto {{ $product->product_name }} ingresado por
            {{ $product->user->name }}</div>
        <div class="card-body">
            @component('components.alerts')
            @endcomponent
            <div class="col-md-10 mx-auto bg-white p-3">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('product.edit',['product' => $product,'op' =>  'edit']) }}" class="btn btn-primary mr-2 my-2">Editar producto</a>
                </div>
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th scole="col">Código</th>
                            <td>{{ $product->id }}</td>
                        </tr>
                        <tr>
                            <th scole="col">Nombre</th>
                            <td>{{ $product->product_name }}</td>
                        </tr>
                        <tr>
                            <th scole="col">Proveedor</th>
                            <td>{{ $product->supplier->supplier_name }}</td>
                        </tr>
                        <tr>
                            <th scole="col">Precio</th>
                            <td>${{ number_format($product->price, 2) }}</td>
                        </tr>
                        <tr>
                            <th scole="col">Código de barras</th>
                            <td>{{ $product->barcode }}</td>
                        </tr>
                        <tr>
                            <th scole="col">Imagén</th>
                            <td class="w-50">
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-50 img-thumbnail"
                                alt="{{ $product->product_name }}">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
