@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Editar Solicitante</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.solicitante.update', $solicitante->id_solicitante) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="estado_solicitud" class="form-label">Estado de Solicitud</label>
                    <input 
                        type="text" 
                        id="estado_solicitud" 
                        name="estado_solicitud" 
                        class="form-control @error('estado_solicitud') is-invalid @enderror"
                        value="{{ old('estado_solicitud', $solicitante->estado_solicitud) }}"
                    >
                    @error('estado_solicitud')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="fecha_solicitud" class="form-label">Fecha de Solicitud</label>
                    <input 
                        type="date" 
                        id="fecha_solicitud" 
                        name="fecha_solicitud" 
                        class="form-control @error('fecha_solicitud') is-invalid @enderror"
                        value="{{ old('fecha_solicitud', $solicitante->fecha_solicitud) }}"
                    >
                    @error('fecha_solicitud')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tiposolicitud" class="form-label">Tipo de Solicitud</label>
                    <input 
                        type="text" 
                        id="tiposolicitud" 
                        name="tiposolicitud" 
                        class="form-control @error('tiposolicitud') is-invalid @enderror"
                        value="{{ old('tiposolicitud', $solicitante->tiposolicitud) }}"
                    >
                    @error('tiposolicitud')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Actualizar</button>
                <a href="{{ route('admin.solicitante') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
