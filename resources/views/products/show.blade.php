@extends('layout')

@section('title', 'Detalle del producto')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Detalle del producto</h5>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Nombre</dt>
            <dd class="col-sm-9">{{ $product->name }}</dd>

            <dt class="col-sm-3">Descripción</dt>
            <dd class="col-sm-9">{{ $product->description ?? 'Sin descripción' }}</dd>

            <dt class="col-sm-3">Precio</dt>
            <dd class="col-sm-9">MXN {{ number_format($product->price, 2, '.', ',') }}</dd>

            <dt class="col-sm-3">Stock</dt>
            <dd class="col-sm-9">{{ $product->stock }}</dd>

            <dt class="col-sm-3">Creado</dt>
            <dd class="col-sm-9">{{ $product->created_at->format('d/m/Y H:i') }}</dd>

            <dt class="col-sm-3">Última actualización</dt>
            <dd class="col-sm-9">{{ $product->updated_at->format('d/m/Y H:i') }}</dd>
        </dl>

        <a href="{{ route('products.index') }}" class="btn btn-secondary">Volver al listado</a>
        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">Editar</a>
        <button type="button" 
            class="btn btn-danger delete-product-button"
            data-bs-toggle="modal"
            data-bs-target="#globalDeleteModal"
            data-action="{{ route('products.destroy', $product) }}"
            data-name="{{ $product->name }}"
        >Eliminar</button>
    </div>
</div>
@endsection
