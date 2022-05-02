@extends('layouts.app')

@section('css')
    <style>
        .badge {
            cursor: pointer;
        }

    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">Productos</div>
        <div class="card-body">
            <h3>Administración de productos</h3>
            @component('components.alerts')
            @endcomponent
            <div class="col-md-10 mx-auto bg-white p-3">
                <div class="d-flex flex-row-reverse">
                    <a href="{{ route('product.create') }}" class="btn btn-primary mr-2 my-2">Agregar producto</a>
                </div>
                <table class="table">
                    <thead class="bg-primary text-light">
                        <tr>
                            <th scole="col">Codigo</th>
                            <th scole="col">Nombre</th>
                            <th scole="col">Precio</th>
                            <th scole="col">Código de barras</th>
                            <th scole="col">Proveedor</th>
                            <th scole="col">Usuario</th>
                            <th scole="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->supplier->supplier_name }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->barcode }}</td>
                                <td>
                                    <a href="{{ route('product.edit', $item) }}">
                                        <span class="badge bg-primary rounded-pill">Editar</span>
                                    </a>
                                    <form class="d-inline"
                                        action="{{ route('product.delete', ['product' => $item]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="badge bg-danger rounded-pill show_confirm border-0"
                                            data-toggle="tooltip" title='Delete'>Delete</button>
                                    </form>
                                    <a href="{{ route('product.show', $item) }}">
                                        <span class="badge bg-secondary rounded-pill">Detalles</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if (!$products->count())
                    <h6 class="text-muted">No hay registro de productos</h6>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="application/javascript">
        $('.show_confirm').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            Swal.fire({
                icon: 'question',
                title: '¿Desea eliminar el registro?',
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                cancelButtonText:'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    </script>
@endsection
