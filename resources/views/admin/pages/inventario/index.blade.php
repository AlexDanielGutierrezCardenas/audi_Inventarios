@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-3 text-center">Kardex Materiales Entrada | Salida</h1>

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-nowrap mb-0">
            <thead class="table-light">
                <tr>
                    <th rowspan="2" class="text-center align-middle">ID Stock</th>
                    <th rowspan="2" class="text-center align-middle">Nombre Material</th>
                    <th rowspan="2" class="text-center align-middle">Unidad Medida</th>
                    <th colspan="3" class="text-center">Ingreso</th>
                    <th colspan="3" class="text-center">Salida</th>
                    <th rowspan="2" class="text-center align-middle">Cantidad Actual</th>
                </tr>
                <tr>
                    <!-- Ingreso -->
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Precio Unitario</th>
                    <th class="text-center">Precio Total</th>
                    <!-- Salida -->
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Precio Unitario</th>
                    <th class="text-center">Precio Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($stockMaterial as $stock)
                    <tr>
                        <td class="text-center">{{ $stock->id_stock }}</td>
                        <td class="text-wrap">{{ $stock->ingresoDetalle->nombrematerial ?? 'Sin nombre' }}</td>
                        <td class="text-wrap">{{ $stock->ingresoDetalle->unidadmedida ?? 'Sin unidad' }}</td>
                        
                        <!-- Datos de Ingreso -->
                        <td class="text-center">{{ $stock->ingresoDetalle->cantidad ?? 'Sin cantidad' }}</td>
                        <td class="text-center">{{ $stock->ingresoDetalle->preciounitario ?? 'Sin precio' }}</td>
                        <td class="text-center">{{ $stock->ingresoDetalle->preciototal ?? 'Sin precio total' }}</td>
                        
                        <!-- Datos de Salida -->
                        <td class="text-center">{{ $stock->salidaDetalle->cantidad ?? 'Sin cantidad' }}</td>
                        <td class="text-center">{{ $stock->salidaDetalle->preciounitario ?? 'Sin precio' }}</td>
                        <td class="text-center">{{ $stock->salidaDetalle->preciototal ?? 'Sin precio total' }}</td>

                        <!-- Cantidad Actual -->
                        <td class="text-center">{{ $stock->cantidad_actual }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No hay datos disponibles</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


@endsection
