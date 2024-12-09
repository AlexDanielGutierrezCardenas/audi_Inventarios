@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="mb-3">
        <h3>Formulario de Registro</h3>
    </div>
    <form action="{{ route('admin.formulario.store') }}" method="POST" class="container mt-4">
        @csrf
        <div class="mb-3">
            <label for="table" class="form-label">Selecciona una tabla:</label>
            <select id="table" name="table" class="form-select" onchange="mostrarCampos(this.value)">
                <option value="">Seleccionar</option>
                <option value="despachador">Despachador</option>
                <option value="solicitante">Solicitante</option>
            </select>
        </div>
    
    
        <!-- Campos para Despachador -->
        <div id="campos-despachador" class="card p-3 mb-3 d-none">
            <h5 class="card-title">Datos del Despachador</h5>
            <div class="mb-3">
                <label for="id_persona" class="form-label">ID Persona:</label>
                <input type="text" id="id_persona" name="id_persona" class="form-control" value="{{ old('id_persona', $id_persona) }}">
            </div>
            <div class="mb-3">
                <label for="turno" class="form-label">Turno:</label>
                <select id="turno" name="turno" class="form-select">
                    <option value="">Seleccionar turno</option>
                    <option value="mañana">Mañana</option>
                    <option value="tarde">Tarde</option>
                    <option value="noche">Noche</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="zona_asignada" class="form-label">Zona Asignada:</label>
                <input type="text" id="zona_asignada" name="zona_asignada" class="form-control" maxlength="255">
            </div>
            <div class="mb-3">
                <label for="fecha_contratacion" class="form-label">Fecha de Contratación:</label>
                <input type="date" id="fecha_contratacion" name="fecha_contratacion" class="form-control">
            </div>
            
            <div class="mb-3">
                <label for="estado_despachador" class="form-label">Estado del Despachador:</label>
                <input type="text" id="estado_despachador" name="estado_despachador" class="form-control" maxlength="255">
            </div>
            <div class="mb-3">
                <label for="contacto" class="form-label">Contacto:</label>
                <input type="text" id="contacto" name="contacto" class="form-control" maxlength="255">
            </div>
        </div>
    
        <!-- Campos para Solicitante -->
        <div id="campos-solicitante" class="card p-3 mb-3 d-none">
            <h5 class="card-title">Datos del Solicitante</h5>
            <div class="mb-3">
                <label for="id_persona" class="form-label">ID Persona:</label>
                <input type="text" id="id_persona" name="id_persona" class="form-control" value="{{ old('id_persona', $id_persona) }}">
            </div>
            <div class="mb-3">
                <label for="estado_solicitud" class="form-label">Estado Solicitud:</label>
                <input type="text" id="estado_solicitud" name="estado_solicitud" class="form-control" maxlength="255">
            </div>
            <div class="mb-3">
                <label for="fecha_solicitud" class="form-label">Fecha de Solicitud:</label>
                <input type="date" id="fecha_solicitud" name="fecha_solicitud" class="form-control">
            </div>
            <div class="mb-3">
                <label for="tipo_solicitud" class="form-label">Tipo de Solicitud:</label>
                <input type="text" id="tipo_solicitud" name="tipo_solicitud" class="form-control" maxlength="255">
            </div>
        </div>
    
        <button type="submit" class="btn btn-success">Enviar</button>
    </form>
    
<script>
        function mostrarCampos(tipo) {
            
            document.querySelectorAll('.card').forEach((card) => card.classList.add('d-none'));
            
            if (tipo) {
                const campos = document.getElementById(`campos-${tipo}`);
                if (campos) {
                    campos.classList.remove('d-none');
                }
            }
        }
    </script>
    <script>
        const hoy = new Date().toISOString().split('T')[0];
        document.getElementById('fecha_contratacion').value = hoy;
        document.getElementById('fecha_solicitud').value = hoy;
    </script>
    
@endsection
