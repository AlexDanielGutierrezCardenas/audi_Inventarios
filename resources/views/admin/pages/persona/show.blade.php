@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Detalles de la Persona</h2>
    <div class="card mt-3">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $persona->nombre }}</p>
            <p><strong>Apellido:</strong> {{ $persona->apellido }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ $persona->fecha_nacimiento }}</p>
            <p><strong>Género:</strong> {{ $persona->genero }}</p>
            <p><strong>Email:</strong> {{ $persona->email }}</p>
            <p><strong>Teléfono:</strong> {{ $persona->telefono }}</p>
            <p><strong>Dirección:</strong> {{ $persona->direccion }}</p>
            <p><strong>Estado Civil:</strong> {{ $persona->estado_civil }}</p>
            <p><strong>Nacionalidad:</strong> {{ $persona->nacionalidad }}</p>
            <p><strong>Número de Identificación:</strong> {{ $persona->numero_identificacion }}</p>
            <p><strong>Ocupación:</strong> {{ $persona->ocupacion }}</p>
            <a href="{{ route('admin.persona') }}" class="btn btn-primary mt-3">Volver</a>
        </div>
    </div>
</div>
@endsection
