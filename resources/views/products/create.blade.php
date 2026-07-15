@extends('layout')

@section('title', 'Nuevo producto')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Crear producto</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('products.store') }}" class="needs-validation" novalidate>
            @csrf
            @include('products.form')
            <div class="mt-4">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
</div>
@endsection
