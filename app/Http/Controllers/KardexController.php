<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kardexdate;

use App\Exports\MaterialExport;
use App\Exports\KardexExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class KardexController extends Controller
{
    public function index()
    {
        // Obtén todos los registros de la tabla kardexdate
        $kardexDates = Kardexdate::all();

        // Retorna la vista con los datos
        return view('admin.pages.kardex.index', compact('kardexDates'));
    }
    public function generateKardexPDF()
    {
        $kardexdates = \App\Models\Kardexdate::all(); // Reemplaza con tu modelo correcto

        $data = [
            'kardexdates' => $kardexdates,
        ];

        $pdf = Pdf::loadView('admin.pages.reportes.pdf.kardex.index', $data)->setPaper('a4', 'landscape');
        return $pdf->download('reporte_kardex.pdf');
    }
    public function exportarKardex()
    {
        return Excel::download(new KardexExport, 'kardex.xlsx');
    }
}
