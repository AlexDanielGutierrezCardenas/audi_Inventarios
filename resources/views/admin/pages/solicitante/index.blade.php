

@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <!-- Botón Create -->
    <div class="mb-3">
        <a href="{{ route('admin.solicitante.create') }}" class="btn btn-primary">Create</a>
    </div>
    <!-- Tabla de Solicitantes -->
    <div class="table-responsive">
        <table class="table text-nowrap mb-0">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Estado de Solicitud</th>
                    <th>Fecha de Solicitud</th>
                    <th>Tipo de Solicitud</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($solicitantes as $solicitante)
                <tr>
                    <td>{{ $solicitante->id_solicitante }}</td>
                    <td>
                        <button 
    class="btn btn-sm estado-btn {{ strtolower($solicitante->estado_solicitud) === 'activo' ? 'btn-success' : 'btn-danger' }}" 
    data-id="{{ $solicitante->id_solicitante }}" 
    data-estado="{{ $solicitante->estado_solicitud }}">
    {{ ucfirst($solicitante->estado_solicitud) }}
</button>
                    </td>
                    <td>{{ $solicitante->fecha_solicitud }}</td>
                    <td>{{ $solicitante->tiposolicitud }}</td>
                    <td>
                        <a href="{{ route('admin.solicitante.show', $solicitante->id_solicitante) }}" class="btn btn-info btn-sm">Mostrar</a>
                        <a href="{{ route('admin.solicitante.edit', $solicitante->id_solicitante) }}" class="btn btn-warning btn-sm">Actualizar</a>
                        <button onclick="confirmDelete({{ $solicitante->id_solicitante }})" class="btn btn-danger btn-sm">Eliminar</button>
                        <form id="delete-form-{{ $solicitante->id_solicitante }}" action="{{ route('admin.solicitante.destroy', $solicitante->id_solicitante) }}" method="POST" style="display: none;">
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

<script>
    document.querySelectorAll('.estado-btn').forEach(button => {
        button.addEventListener('click', function () {
            const solicitanteId = this.dataset.id;
            const currentEstado = this.dataset.estado;

            // Hacer la solicitud al servidor
            fetch(`/admin/solicitante/${solicitanteId}/estado`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualizar el estado y el estilo del botón
                    this.textContent = data.nuevoEstado;
                    this.dataset.estado = data.nuevoEstado;
                    this.classList.toggle('btn-success', data.nuevoEstado === 'Activo');
                    this.classList.toggle('btn-danger', data.nuevoEstado === 'Inactivo');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>


@endsection