@extends('layouts.admin')

@section('content')
<style>
    .table-inventario thead th {
        background-color: #4CAF50; /* Fondo verde */
        color: white; /* Texto blanco */
        text-align: center; /* Centrar texto */
    }
    .table-inventario tbody td {
        vertical-align: middle; /* Centrar verticalmente */
    }
    .table-inventario tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9; /* Color alterno para filas */
    }
    .table-inventario tbody tr:hover {
        background-color: #f1f1f1; /* Efecto hover */
    }
    .table-inventario .text-right {
        text-align: right; /* Alinear precios a la derecha */
    }
    .titulo-inventario {
        text-align: center; /* Centrar título */
        font-size: 50px; /* Tamaño de fuente */
        font-weight: bold; /* Negrita */
        color: #42c9d3; /* Color verde */
        margin-bottom: 20px; /* Espaciado inferior */
        font-style: initial;
        
    }
</style>

<div class="titulo-inventario">Inventarios</div>


<form action="{{ route('generate.excel') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="btn btn-success">
        Exportar Inventario a Excel
    </button>
</form>


<form action="{{ route('generate.inventario.pdf') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="btn btn-primary">
        Exportar Inventario a PDF
    </button>
</form>

<table class="table table-striped table-hover table-bordered table-inventario">
    <thead>
        <tr>
            <th>ID Material</th>
            <th>Nombre del Material</th>
            <th>Cantidad</th>
            <th>Unidad de Medida</th>
            <th>Precio Unitario</th>
            <th>Precio Total</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($inventario as $item)
            <tr>
                <td>{{ $item->id_material }}</td>
                <td>{{ $item->nombrematerial }}</td>
                <td>{{ $item->cantidad }}</td>
                <td>{{ $item->unidadmedida }}</td>
                <td class="text-right">Bs. {{ number_format($item->preciounitario, 2) }}</td>
                <td class="text-right">Bs. {{ number_format($item->preciototal, 2) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center text-muted">No hay registros en el inventario</td>
            </tr>
        @endforelse
    </tbody>
</table>


@endsection