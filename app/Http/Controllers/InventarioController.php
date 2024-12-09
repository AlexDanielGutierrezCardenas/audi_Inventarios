<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IngresoDetalles;
use App\Models\Material;
use App\Models\Ingreso;
use App\Models\StockMaterial;

class InventarioController extends Controller
{

    public function adminInventario()
    {
        $stockMaterial = StockMaterial::with('ingresoDetalle')->get();
        return view('admin.pages.inventario.index',["msg"=>"Hello! I am admin"], compact('stockMaterial'));
    }
    public function detalles($id_ingreso)
    {
        // Obtener los detalles del ingreso con los datos del material
        $ingreso = Ingreso::with('detalles.material')->find($id_ingreso);

        if (!$ingreso) {
            return redirect()->back()->with('error', 'Ingreso no encontrado');
        }

        // Pasar los detalles a la vista
        $detalles = $ingreso->detalles;

        return view('admin.pages.ingresodetalles.index', compact('detalles', 'ingreso'));
    }
}

