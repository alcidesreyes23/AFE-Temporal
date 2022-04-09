@extends('layouts.app')

@section('css')
    <style>
        .badge {
            cursor: pointer;
        }
    </style>
@endsection

@section('buttons')
    <a href="{{ route('product.create') }}" class="btn btn-primary mr-2">Agregar producto</a>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">Productos</div>
        <div class="card-body">
            <h3>Administración de productos</h3>

            @component('components.alerts')
            @endcomponent

            <div class="col-md-10 mx-auto bg-white p-3">
                <table class="table">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th scole="col">Codigo</th>
                            <th scole="col">Proveedor</th>
                            <th scole="col">Usuario</th>
                            <th scole="col">Nombre</th>
                            <th scole="col">Precio</th>
                            <th scole="col">Código de barras</th>
                            <th scole="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->supplier->supplier_name}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->product_name}}</td>
                                <td>${{ number_format($item->price,2)}}</td>
                                <td>{{$item->barcode}}</td>
                                <td>
                                    <span class="badge bg-primary rounded-pill">Editar</span>
                                    <form class="d-inline" action="{{route('product.delete',['product' => $item])}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn">
                                            <span class="badge bg-danger rounded-pill">Delete</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($products->count())
                    <h6 class="text-muted">No hay registro de productos</h6>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
