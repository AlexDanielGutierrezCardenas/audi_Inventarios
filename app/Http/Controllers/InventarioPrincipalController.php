<?php

namespace App\Http\Controllers;
use App\Models\Inventario;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

use App\Exports\InventarioExport;
use Maatwebsite\Excel\Facades\Excel;

class InventarioPrincipalController extends Controller
{
    public function index()
    {
        $inventario = Inventario::all(); // O tu lógica para obtener los datos
        return view('admin.pages.inventarioprincipal.index', compact('inventario'));
    }
    public function generatePDF()
    {
        $data = [
            'title' => 'Reporte PDF',
            'content' => 'Contenido de prueba para el PDF.',
            'personas' => \App\Models\Persona::all() 
        ];

        $pdf = Pdf::loadView('admin.pages.reportes.pdf.inventarios.index', $data);
        return $pdf->download('reporte.pdf');
    }
    public function generateInventarioPDF()
    {
        $inventarios = \App\Models\Inventario::all(); // Asegúrate de que este modelo exista y tenga los datos correctos.

        $data = [
            'inventarios' => $inventarios
        ];

        $pdf = Pdf::loadView('admin.pages.reportes.pdf.inventarios.index', $data)->setPaper('a4', 'landscape');
        return $pdf->download('reporte_materiales.pdf');
    }

    public function generateExcel()
    {
        return Excel::download(new InventarioExport, 'reporteInvenatario.xlsx');
    }
}
