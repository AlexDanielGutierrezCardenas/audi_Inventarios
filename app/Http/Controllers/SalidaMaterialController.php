<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalidaMaterial;
use App\Models\Area;
use App\Models\Proveedor;
use App\Models\Solicitante;
use App\Models\Despachador;
use App\Models\Material;
use App\Models\SalidaDetalles;
use App\Models\Ingreso;
use App\Models\StockMaterial;
use App\Models\kardexdate;
use App\Models\Inventario;
use DB;

class SalidaMaterialController extends Controller
{
    public function adminSalidaMaterial(Request $request)
{
    // Obtener todas las áreas, proveedores, solicitantes y despachadores
    $areas = Area::all();
    $proveedores = Proveedor::all();
    $solicitantes = Solicitante::with('persona')->get(); // Asegúrate de que esta relación está correctamente definida en el modelo
    $despachadores = Despachador::with('persona')->get();
    $materials = Material::all(); // Obtener todos los materiales

    // Filtrar las salidas si se seleccionó un área
    $salidas = SalidaMaterial::with(['area', 'proveedor', 'solicitante', 'despachador']);

    if ($request->has('id_area') && $request->get('id_area') != '') {
        $salidas = $salidas->where('id_area', $request->get('id_area'));
    }

    $salidas = $salidas->get(); // Obtener las salidas filtradas
    // Pasar los datos a la vista
    return view('admin.pages.salidamaterial.index', compact('salidas', 'areas', 'proveedores', 'solicitantes', 'despachadores', 'materials'));
}


    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'id_area' => 'required|exists:area,id_area',
            'id_proveedor' => 'required|exists:proveedoraqui,id_proveedor',
            'id_solicitante' => 'required|exists:solicitante,id_solicitante',
            'id_despachador' => 'required|exists:despachador,id_despachador',
            'id_material' => 'required|exists:material,id_material',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
            'precio_total' => 'required|numeric',
        ]);
        $salidaMaterial = new salidaMaterial();
        $salidaMaterial->id_area = $request->id_area;
        $salidaMaterial->id_proveedor = $request->id_proveedor;
        $salidaMaterial->id_solicitante = $request->id_solicitante;
        $salidaMaterial->id_despachador = $request->id_despachador;
        $salidaMaterial->id_material = $request->id_material;
        $salidaMaterial->cantidad = $request->cantidad;
        $salidaMaterial->precio_unitario = $request->precio_unitario;
        $salidaMaterial->precio_total = $request->cantidad * $request->precio_unitario;
        $salidaMaterial->save();
        $id_salida = $salidaMaterial->id_salida;

        $material = Material::find($request->id_material);
        if ($material) {
            $nombreMaterial = $material->nombre;
            $unidadMaterial = $material->unidad;
        } else {
            return 'Material no encontrado';
        }
        $salidadetalles = new SalidaDetalles();
        $salidadetalles->id_salida = $id_salida;
        $salidadetalles->id_material = $request->id_material;
        $salidadetalles->nombrematerial = $nombreMaterial;
        $salidadetalles->unidadmedida = $unidadMaterial;
        $salidadetalles->cantidad = $request->cantidad;
        $salidadetalles->preciounitario = $request->precio_unitario;
        $salidadetalles->preciototal = $request->cantidad * $request->precio_unitario;
        $salidadetalles->save();
        $id_detalle_salida = $salidadetalles->id_detalle_salida;

        $stock = StockMaterial::where('id_material', $request->id_material)->first();

        if ($stock) {
            $stock->cantidad_actual -= $request->cantidad;
            $stock->save();
        }
        
        $kardexAnterior = kardexdate::where('id_material', $request->id_material)
                            ->orderBy('id_kardexdate', 'desc') // Ordenar por ID descendente (último registro)
                            ->first();

        if ($kardexAnterior) {
        
            $saldoAnterior = $kardexAnterior->saldototal; 
            
        } else {
            
            $saldoAnterior = 0;
           
        }
        // Calculamos el saldo de ingreso
        $saldoingreso = $request->cantidad * $request->precio_unitario;

        $kardexdate = new kardexdate();
        $kardexdate->detalle = 'salida de materiales';
        $kardexdate->id_material = $request->id_material;
        $kardexdate->id_salida = $id_salida;
        $kardexdate->cantidad_salida = $request->cantidad;
        $kardexdate->cantidad = $stock->cantidad_actual;
        $kardexdate->precio_unitario = $request->precio_unitario;
        $kardexdate->saldoingreso = $saldoingreso;

        $kardexdate->saldototal = $saldoAnterior - $saldoingreso;

        
        $kardexdate->save();


        $inventario = Inventario::where('id_material', $request->id_material)->first();

        if ($inventario) {
            $inventario->cantidad = $stock->cantidad_actual;
            $inventario->preciototal = $kardexdate->saldototal;
            $inventario->save();
        }

        return redirect()->route('admin.salidamaterial')->with('success', 'Ingreso de material registrado correctamente.');
    }

    public function verificarExistencia(Request $request)
    {
        // Validar el parámetro recibido
        $request->validate([
            'id_material' => 'required',
        ]);

        
        $material = DB::table('ingreso')->where('id_material', $request->id_material)->first();

       
        if ($material) {
            // Si existe, devolver el precio_unitario
            return response()->json([
                'exists' => true,
                'precio_unitario' => $material->precio_unitario, // Devuelve el precio_unitario
            ]);
        } else {
            return response()->json([
                'exists' => false,
            ]);
        }
    }

    public function verificarStock(Request $request)
    {
        
        $request->validate([
            'id_material' => 'required',
        ]);
        
        $stock = DB::table('stockmaterial')->where('id_material', $request->id_material)->first();
        // Verificar si el material existe
        if ($stock) {
            // Si existe, devolver el precio_unitario
            return response()->json([
                'exists' => true,
                'cantidad_actual' => $stock->cantidad_actual, // Devuelve el precio_unitario
            ]);
        } else {
            return response()->json([
                'exists' => false,
            ]);
        }
    }
        

    

    
}
