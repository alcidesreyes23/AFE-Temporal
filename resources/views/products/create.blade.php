@extends('layouts.app')

@section('buttons')
    <a href="{{ route('product.index') }}" class="btn btn-primary mr-2">Regresar</a>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">Agregar Producto</div>
        <div class="card-body">
            <div class="col-md-10 mx-auto bg-white p-3">
                <form method="POST" action="{{ route('product.store') }}" novalidate>
                    @csrf
                    <div class="row mb-3">
                        <label for="">Proveedor</label>
                        <div class="col-md-6">
                            <select name="supplier_id" id="supplier_id" class="form-control" value="{{ old('supplier_id') }}">
                                <option value="">Seleccione proveedor</option>
                                @foreach ($suppliers as $id => $name)
                                    <option value="{{$id}}">{{$name}}</option>
                                @endforeach
                            </select>
                            @error('supplier_id')
                                <br />
                                <span class="text-danger fw-bold">{{ $message }}</span>
                                <br />
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="">Titulo del producto</label>
                        <div class="col-md-6">
                            <input type="text" name="product_name" id="product_name" class="form-control"
                                placeholder="Nombre del producto" value="{{ old('product_name') }}">
                            @error('product_name')
                                <br />
                                <span class="text-danger fw-bold">{{ $message }}</span>
                                <br />
                            @enderror
                        </div>
                    </div>
                    <div class="row-mb-0"></div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Agregar producto">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
