<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Materiales</title>
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
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            display: block;
            margin: 0 auto;
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('admin_assets/images/logo/images.jpeg'))) }}" alt="Logo">
    <h1>Reporte de Materiales</h1>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Unidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materiales as $material)
            <tr>
                <td>{{ $material->codigo_material }}</td>
                <td>{{ $material->nombre }}</td>
                <td>{{ $material->unidad }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
