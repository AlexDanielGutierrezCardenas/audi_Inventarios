@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    <div class="mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Crear Material</button>
        <a href="{{ route('exportar.material') }}" class="btn btn-success">Exportar Materiales a Excel</a>
        <a href="{{ route('reporte.materiales.pdf') }}" class="btn btn-primary">
            Descargar Reporte PDF
        </a>
        

    </div>

    <!-- Tabla de materiales -->
    <div class="table-responsive">
        <table class="table text-nowrap mb-0">
            <thead class="table-light">
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Unidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materiales as $material)
                <tr>
                    <td>{{ $material->codigo_material }}</td>
                    <td>{{ $material->nombre }}</td>
                    <td>{{ $material->unidad }}</td>
                    <td>
                        <!-- Botón para abrir el modal de edición -->
                        <button class="btn btn-warning btn-sm" onclick="openEditModal({{ $material }})">Editar</button>
                        <button onclick="confirmDelete({{ $material->id_material }})" class="btn btn-danger btn-sm">Eliminar</button>
                        <form id="delete-form-{{ $material->id_material }}" action="{{ route('admin.material.destroy', $material->id_material) }}" method="POST" style="display: none;">
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

<!-- Modal para crear material -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.material.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Crear Material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="create_codigo_material" class="form-label">Código</label>
                        <input type="text" class="form-control" id="create_codigo_material" name="codigo_material" required>
                    </div>
                    <div class="mb-3">
                        <label for="create_nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="create_nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="create_unidad" class="form-label">Unidad</label>
                        <input type="text" class="form-control" id="create_unidad" name="unidad" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal para editar material -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Editar Material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_codigo_material" class="form-label">Código</label>
                        <input type="text" class="form-control" id="edit_codigo_material" name="codigo_material" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="edit_nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_unidad" class="form-label">Unidad</label>
                        <input type="text" class="form-control" id="edit_unidad" name="unidad" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </form>
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

function openEditModal(material) {
    document.getElementById('edit_codigo_material').value = material.codigo_material;
    document.getElementById('edit_nombre').value = material.nombre;
    document.getElementById('edit_unidad').value = material.unidad;

    document.getElementById('editForm').action = `{{ route('admin.material.update', '') }}/${material.id_material}`;
    new bootstrap.Modal(document.getElementById('editModal')).show();
}

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
