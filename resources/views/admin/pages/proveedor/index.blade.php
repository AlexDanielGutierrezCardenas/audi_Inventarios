@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <!-- Botón Create -->
    <div class="mb-3">
        <a href="{{ route('admin.proveedor.create') }}" class="btn btn-primary">Create</a>
    </div>
    <!-- Tabla de Proveedores -->
    <div class="table-responsive">
        <table class="table text-nowrap mb-0">
            <thead class="table-light">
                <tr>
                    <th>Código</th>
                    <th>Nombre Proveedor</th>
                    <th>Dirección</th>
                    <th>NIT</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proveedores as $proveedor)
                <tr>
                    <td>{{ $proveedor->codigo }}</td>
                    <td>{{ $proveedor->nombre_proveedor }}</td>
                    <td>{{ $proveedor->direccion }}</td>
                    <td>{{ $proveedor->nit }}</td>
                    <td>{{ $proveedor->telefono }}</td>
                    <td>
                        <a href="{{ route('admin.proveedor.show', $proveedor->id_proveedor) }}" class="btn btn-info btn-sm">Mostrar</a>
                        <a href="{{ route('admin.proveedor.edit', $proveedor->id_proveedor) }}" class="btn btn-warning btn-sm">Actualizar</a>
                        <button onclick="confirmDelete({{ $proveedor->id_proveedor }})" class="btn btn-danger btn-sm">Eliminar</button>
                        <form id="delete-form-{{ $proveedor->id_proveedor }}" action="{{ route('admin.proveedor.destroy', $proveedor->id_proveedor) }}" method="POST" style="display: none;">
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

