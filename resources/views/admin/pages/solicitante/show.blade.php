@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Detalle del Solicitante</h3>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $solicitante->id }}</p>
            <p><strong>Estado de Solicitud:</strong> {{ $solicitante->estado_solicitud }}</p>
            <p><strong>Fecha de Solicitud:</strong> {{ $solicitante->fecha_solicitud }}</p>
            <p><strong>Tipo de Solicitud:</strong> {{ $solicitante->tiposolicitud }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.solicitante') }}" class="btn btn-secondary">Volver</a>
            <a href="{{ route('admin.solicitante.edit', $solicitante->id_solicitante) }}" class="btn btn-warning">Editar</a>
        </div>
    </div>
</div>
@endsection
