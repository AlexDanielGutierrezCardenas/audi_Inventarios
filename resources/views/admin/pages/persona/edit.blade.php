@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Editar Persona</h2>
    <form action="{{ route('admin.persona.update', $persona->id_persona) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $persona->nombre }}" required>
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $persona->apellido }}" required>
        </div>

        <div class="mb-3">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ $persona->fecha_nacimiento }}" required>
        </div>

        <div class="mb-3">
            <label for="genero" class="form-label">Género</label>
            <input type="text" class="form-control" id="genero" name="genero" value="{{ $persona->genero }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $persona->email }}" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $persona->telefono }}" required>
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $persona->direccion }}" required>
        </div>

        <div class="mb-3">
            <label for="estado_civil" class="form-label">Estado Civil</label>
            <input type="text" class="form-control" id="estado_civil" name="estado_civil" value="{{ $persona->estado_civil }}" required>
        </div>

        <div class="mb-3">
            <label for="nacionalidad" class="form-label">Nacionalidad</label>
            <input type="text" class="form-control" id="nacionalidad" name="nacionalidad" value="{{ $persona->nacionalidad }}" required>
        </div>

        <div class="mb-3">
            <label for="numero_identificacion" class="form-label">Número de Identificación</label>
            <input type="text" class="form-control" id="numero_identificacion" name="numero_identificacion" value="{{ $persona->numero_identificacion }}" required>
        </div>

        <div class="mb-3">
            <label for="ocupacion" class="form-label">Ocupación</label>
            <input type="text" class="form-control" id="ocupacion" name="ocupacion" value="{{ $persona->ocupacion }}" required>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('admin.personas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
