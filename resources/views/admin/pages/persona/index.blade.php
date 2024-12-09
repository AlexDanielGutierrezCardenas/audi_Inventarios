@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <!-- Botón Create -->
    <div class="mb-3">
        <a href="{{ route('admin.persona.create') }}" class="btn btn-primary">Create</a>
    </div>
    <!-- Tabla de Personas -->
    <div class="table-responsive">
        <table class="table text-nowrap mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Género</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Estado Civil</th>
                    <th>Nacionalidad</th>
                    <th>Número de Identificación</th>
                    <th>Ocupación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($personas as $persona)
                <tr>
                    <td>{{ $persona->nombre }}</td>
                    <td>{{ $persona->apellido }}</td>
                    <td>{{ $persona->fecha_nacimiento }}</td>
                    <td>{{ $persona->genero }}</td>
                    <td>{{ $persona->email }}</td>
                    <td>{{ $persona->telefono }}</td>
                    <td>{{ $persona->direccion }}</td>
                    <td>{{ $persona->estado_civil }}</td>
                    <td>{{ $persona->nacionalidad }}</td>
                    <td>{{ $persona->numero_identificacion }}</td>
                    <td>{{ $persona->ocupacion }}</td>
                    <td>
                        <a href="{{ route('admin.persona.show', $persona->id_persona) }}" class="btn btn-info btn-sm">Mostrar</a>
                        <a href="{{ route('admin.persona.edit', $persona->id_persona) }}" class="btn btn-warning btn-sm">Actualizar</a>
                        <button onclick="confirmDelete({{ $persona->id_persona }})" class="btn btn-danger btn-sm">Eliminar</button>
                        <form id="delete-form-{{ $persona->id_persona }}" action="{{ route('admin.persona.destroy', $persona->id_persona) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede deshacer",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`delete-form-${id}`).submit();
        }
    });
}

// Mostrar SweetAlert2 para mensajes de éxito
@if (session('success'))
Swal.fire({
    icon: 'success',
    title: '¡Éxito!',
    text: "{{ session('success') }}",
    confirmButtonColor: '#3085d6'
});
@endif
</script>

@endsection
