@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Detalles del Proveedor</h2>

    <!-- Detalles del Proveedor -->
    <div class="card">
        <div class="card-body">
            <p><strong>Código:</strong> {{ $proveedor->codigo }}</p>
            <p><strong>Nombre Proveedor:</strong> {{ $proveedor->nombre_proveedor }}</p>
            <p><strong>Dirección:</strong> {{ $proveedor->direccion }}</p>
            <p><strong>NIT:</strong> {{ $proveedor->nit }}</p>
            <p><strong>Teléfono:</strong> {{ $proveedor->telefono }}</p>
        </div>
    </div>

    <a href="{{ route('admin.proveedor') }}" class="btn btn-secondary mt-3">Volver a la lista</a>
    <a href="{{ route('admin.proveedor.edit', $proveedor->id_proveedor) }}" class="btn btn-warning mt-3">Editar</a>
</div>
@endsection
