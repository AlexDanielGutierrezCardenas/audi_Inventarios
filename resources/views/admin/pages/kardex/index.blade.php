@extends('layouts.admin')

@section('content')

<div class="container">
    <h1 class="mb-4">Kardex</h1>
    <form action="{{ route('exportar.kardex') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="btn btn-success">
            Exportar Kardex a Excel
        </button>
    </form>
    <a href="{{ route('generate.kardex.pdf') }}" class="btn btn-primary">Exportar Kardex a PDF</a>
    
    <table class="table table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>ID Kardexdate</th>
                <th>Detalle</th>
                <th>Cantidad Ingreso</th>
                <th>Cantidad Salida</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Saldo Ingreso</th>
                <th>Saldo Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kardexDates as $kardex)
                <tr>
                    <td>{{ $kardex->id_kardexdate }}</td>
                    <td>{{ $kardex->detalle }}</td>
                    <td class="bg-ingreso">{{ $kardex->cantidad_ingreso }}</td> <!-- Fondo verde -->
                    <td class="bg-salida">{{ $kardex->cantidad_salida }}</td> <!-- Fondo rojo -->
                    <td>{{ $kardex->cantidad }}</td>
                    <td>Bs. {{ number_format($kardex->precio_unitario, 2) }}</td> <!-- Formato monetario -->
                    <td>Bs. {{ number_format($kardex->saldoingreso, 2) }}</td> <!-- Formato monetario -->
                    <td>Bs. {{ number_format($kardex->saldototal, 2) }}</td> <!-- Formato monetario -->
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">No hay registros en la tabla Kardex</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    
    
</div>


@endsection
<style>
    .table thead th {
        background-color: #343a40; /* Color de fondo del encabezado */
        color: #fff; /* Color del texto del encabezado */
        text-align: center; /* Centrar el texto */
    }
    .table tbody td {
        vertical-align: middle; /* Centrar verticalmente el contenido */
    }
    .bg-ingreso {
        background-color: #d4edda; /* Fondo verde claro */
        color: #155724; /* Texto verde oscuro */
        font-weight: bold; /* Texto en negrita */
    }
    .bg-salida {
        background-color: #f8d7da; /* Fondo rojo claro */
        color: #721c24; /* Texto rojo oscuro */
        font-weight: bold; /* Texto en negrita */
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f9f9f9; /* Alternar filas */
    }
    .table-hover tbody tr:hover {
        background-color: #f1f1f1; /* Efecto hover */
    }
</style>