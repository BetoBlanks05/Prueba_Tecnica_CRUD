@extends('layout')

@section('title', 'Productos')

@section('content')
<div class="card">
    <div class="card-header d-flex flex-column flex-md-row gap-2 align-items-start align-items-md-center justify-content-between">
        <div>
            <h5 class="card-title mb-0">Productos</h5>
            <p class="small text-muted mb-0">Administra el catálogo de productos.</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-success">Nuevo producto</a>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('products.index') }}" class="mb-3">
            <div class="input-group">
                <input type="search" name="search" value="{{ request('search') }}" class="form-control" placeholder="Buscar por nombre o descripción">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody id="productTableBody">
                    @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($product->description, 70) }}</td>
                            <td>MXN {{ number_format($product->price, 2, '.', ',') }}</td>
                            <td>
                                @if ($product->stock === 0)
                                    <span class="badge bg-danger">Agotado</span>
                                @elseif ($product->stock <= 10)
                                    <span class="badge bg-warning text-dark">{{ $product->stock }}</span>
                                @else
                                    <span class="badge bg-success">{{ $product->stock }}</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                                <button type="button" 
                                    class="btn btn-sm btn-outline-danger delete-product-button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#globalDeleteModal"
                                    data-action="{{ route('products.destroy', $product) }}"
                                    data-name="{{ $product->name }}"
                                >Eliminar</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No se encontraron productos.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchForm = document.querySelector('form[action="{{ route('products.index') }}"]');
        const paginationLinks = document.querySelectorAll('.pagination a');
        const tableBody = document.getElementById('productTableBody');

        const showSkeleton = () => {
            if (!tableBody) return;
            const skeletonRows = Array(5).fill(0).map(() => `
                <tr>
                    <td><div class="skeleton"></div></td>
                    <td><div class="skeleton"></div></td>
                    <td><div class="skeleton" style="width: 80%;"></div></td>
                    <td><div class="skeleton" style="width: 50%;"></div></td>
                    <td class="text-end">
                        <div class="skeleton d-inline-block rounded" style="width: 35px; height: 31px;"></div>
                        <div class="skeleton d-inline-block rounded mx-1" style="width: 50px; height: 31px;"></div>
                        <div class="skeleton d-inline-block rounded" style="width: 65px; height: 31px;"></div>
                    </td>
                </tr>
            `).join('');
            tableBody.innerHTML = skeletonRows;
        };

        if (searchForm) {
            searchForm.addEventListener('submit', showSkeleton);
        }

        if (paginationLinks) {
            paginationLinks.forEach(link => {
                link.addEventListener('click', showSkeleton);
            });
        }
    });
</script>
@endsection
