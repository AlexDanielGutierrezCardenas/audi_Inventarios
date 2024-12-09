<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Kardex</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Reporte Kardex</h1>
    <table>
        <thead>
            <tr>
                <th>ID Kardex Date</th>
                <th>Detalle</th>
                <th>ID Ingreso</th>
                <th>ID Salida</th>
                <th>ID Material</th>
                <th>Cantidad Ingreso</th>
                <th>Cantidad Salida</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Saldo Ingreso</th>
                <th>Saldo Salida</th>
                <th>Saldo Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kardexdates as $kardex)
            <tr>
                <td>{{ $kardex->id_kardexdate }}</td>
                <td>{{ $kardex->detalle }}</td>
                <td>{{ $kardex->id_ingreso }}</td>
                <td>{{ $kardex->id_salida }}</td>
                <td>{{ $kardex->id_material }}</td>
                <td>{{ number_format($kardex->cantidad_ingreso, 2) }}</td>
                <td>{{ number_format($kardex->cantidad_salida, 2) }}</td>
                <td>{{ number_format($kardex->cantidad, 2) }}</td>
                <td>{{ number_format($kardex->precio_unitario, 2) }}</td>
                <td>{{ number_format($kardex->saldoingreso, 2) }}</td>
                <td>{{ number_format($kardex->saldosalida, 2) }}</td>
                <td>{{ number_format($kardex->saldototal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
