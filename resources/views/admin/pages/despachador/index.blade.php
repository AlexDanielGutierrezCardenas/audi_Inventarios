@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    <div class="table-responsive">
        <table class="table text-nowrap mb-0">
            <thead class="table-light">
                <tr>
                    <th>Turno</th>
                    <th>Zona Asignada</th>
                    <th>Fecha Contratación</th>
                    <th>Estado Despachador</th>
                    <th>Contacto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($despachadores as $despachador)
                <tr>
                    <td>{{ $despachador->turno }}</td>
                    <td>{{ $despachador->zona_asignada }}</td>
                    <td>{{ \Carbon\Carbon::parse($despachador->fecha_contratacion)->format('d/m/Y') }}</td>
                    <td>{{ $despachador->estado_despachador }}</td>
                    <td>{{ $despachador->contacto }}</td>
                    <td>
                        <a href="{{ route('admin.despachador.show', $despachador->id_despachador) }}" class="btn btn-info btn-sm">Mostrar</a>
                        <a href="{{ route('admin.despachador.edit', $despachador->id_despachador) }}" class="btn btn-warning btn-sm">Actualizar</a>
                        <button onclick="confirmDelete({{ $despachador->id_despachador }})" class="btn btn-danger btn-sm">Eliminar</button>
                        <form id="delete-form-{{ $despachador->id_despachador }}" action="{{ route('admin.despachador.destroy', $despachador->id_despachador) }}" method="POST" style="display: none;">
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
