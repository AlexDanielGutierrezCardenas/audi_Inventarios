@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h4>Actualizar Despachador</h4>

    <form action="{{ route('admin.despachador.update', $despachador->id_despachador) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="turno" class="form-label">Turno</label>
            <input type="text" class="form-control" id="turno" name="turno" value="{{ old('turno', $despachador->turno) }}" required>
        </div>
        <div class="mb-3">
            <label for="zona_asignada" class="form-label">Zona Asignada</label>
            <input type="text" class="form-control" id="zona_asignada" name="zona_asignada" value="{{ old('zona_asignada', $despachador->zona_asignada) }}" required>
        </div>
        <div class="mb-3">
            <label for="fecha_contratacion" class="form-label">Fecha de Contratación</label>
            <input type="date" class="form-control" id="fecha_contratacion" name="fecha_contratacion" value="{{ old('fecha_contratacion', $despachador->fecha_contratacion) }}" required>
        </div>
        <div class="mb-3">
            <label for="estado_despachador" class="form-label">Estado Despachador</label>
            <input type="text" class="form-control" id="estado_despachador" name="estado_despachador" value="{{ old('estado_despachador', $despachador->estado_despachador) }}" required>
        </div>
        <div class="mb-3">
            <label for="contacto" class="form-label">Contacto</label>
            <input type="text" class="form-control" id="contacto" name="contacto" value="{{ old('contacto', $despachador->contacto) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
