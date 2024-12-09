<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Factura;
use App\Models\Material;
use App\Models\IngresoMaterial;
use App\Models\StockMaterial;
use App\Models\kardexdate;
use App\Models\Inventario;

use App\Models\IngresoDetalles;
use Carbon\Carbon;

class IngresoMaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminIngresoMaterial()
    {
        $ingresos = IngresoMaterial::with(['proveedor', 'factura', 'material'])->get();
        $proveedores = Proveedor::all();
        $facturas = Factura::all();
        $factura = Factura::first();
        $fechaEmision = now()->format('Y-m-d');
        $materials = Material::all();
        if ($facturas->isEmpty()) {
            $factura = new Factura();
            $factura->numero_documento = '00000001';
            $factura->numero_factura = '1000';
            $factura->fecha_emision = Carbon::now();  // Fecha actual
            $factura->save();
            $facturas = Factura::all();
        }
        $facturas = Factura::all()->map(function ($factura) {
            return [
                'id_factura' => $factura->id_factura,
                'numero_documento' => $factura->numero_documento,
                'numero_factura' => $factura->numero_factura,
                'fecha_emision' => $factura->fecha_emision->format('Y-m-d'),
            ];
        });
        
        $ultimoNumero = $facturas->max('numero_documento');
        
        if ($ultimoNumero) {
            $nuevoNumero = str_pad((int) $ultimoNumero + 1, 8, '0', STR_PAD_LEFT);
        } else {
            $nuevoNumero = '00000001';
        }
        

        return view('admin.pages.ingresomaterial.index', ['factura' => $factura], compact('materials', 'proveedores', 'facturas','ingresos','nuevoNumero','fechaEmision'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'numero_documento' => 'required|string|max:255',
            'numero_factura' => 'required|string|max:255',
            'fecha_emision' => 'required|date',
            'id_proveedor' => 'required|exists:proveedoraqui,id_proveedor',
            'id_material' => 'required|exists:material,id_material',
            'cantidad' => 'required|integer|min:1',
            'precio_unitario' => 'required|numeric|min:0',
        ]);
        $factura = new Factura();
        $factura->numero_documento = $request->numero_documento;
        $factura->numero_factura = $request->numero_factura;
        $factura->fecha_emision = $request->fecha_emision;
        $factura->save();
        $id_factura = $factura->id_factura;

        $ingresomaterial = new IngresoMaterial();
        $ingresomaterial->id_proveedor = $request->id_proveedor;
        $ingresomaterial->id_material = $request->id_material;
        $ingresomaterial->id_factura = $id_factura;
        $ingresomaterial->cantidad = $request->cantidad;
        $ingresomaterial->precio_unitario = $request->precio_unitario;
        $ingresomaterial->precio_total = $request->cantidad * $request->precio_unitario;
        $ingresomaterial->save();
        $id_ingreso = $ingresomaterial->id_ingreso;

        
        $material = Material::find($request->id_material);
        if ($material) {
            $nombreMaterial = $material->nombre;
            $unidadMaterial = $material->unidad;
        } else {
            return 'Material no encontrado';
        }
        $ingresodetalles = new IngresoDetalles();
        $ingresodetalles->id_ingreso = $id_ingreso;
        $ingresodetalles->nombrematerial = $nombreMaterial;
        $ingresodetalles->unidadmedida = $unidadMaterial;
        $ingresodetalles->cantidad = $request->cantidad;
        $ingresodetalles->preciounitario = $request->precio_unitario;
        $ingresodetalles->preciototal = $request->cantidad * $request->precio_unitario;
        $ingresodetalles->save();
        $id_detalle = $ingresodetalles->id_detalle;

        $stock = StockMaterial::where('id_material', $request->id_material)->first();

        if ($stock) {
            $stock->cantidad_actual += $request->cantidad;
            $stock->save();
        } else {
            $stock = new StockMaterial();
            $stock->id_detalle = $id_detalle;
            $stock->id_material = $request->id_material;
            $stock->cantidad_actual = $request->cantidad;
            $stock->estado = 'activo';
            $stock->save();
        }
        $kardexAnterior = kardexdate::where('id_material', $request->id_material)
                            ->orderBy('id_kardexdate', 'desc') 
                            ->first();

        if ($kardexAnterior) {
        
            $saldoAnterior = $kardexAnterior->saldototal;
        
        } else {
            
            $saldoAnterior = 0;
            //return response()->json(['message' => 'No hay registros previos para este id_material.']);
        }

        // Calculamos el saldo de ingreso
        $saldoingreso = $request->cantidad * $request->precio_unitario;
        // Creamos o actualizamos el nuevo registro de Kardex
        $kardexdate = new kardexdate();
        $kardexdate->detalle = 'Ingreso de materiales';
        $kardexdate->id_material = $request->id_material;
        $kardexdate->id_ingreso = $id_ingreso; // Agregar el ID del ingreso
        $kardexdate->cantidad_ingreso = $request->cantidad;
        $kardexdate->cantidad = $stock->cantidad_actual;
        $kardexdate->precio_unitario = $request->precio_unitario;
        $kardexdate->saldoingreso = $saldoingreso;

        // Calculamos el nuevo saldo total
        $kardexdate->saldototal = $saldoAnterior + $saldoingreso;

        // Guardamos el nuevo registro
        $kardexdate->save();

        $inventario = Inventario::where('id_material', $request->id_material)->first();

        if ($inventario) {
            $inventario->cantidad = $stock->cantidad_actual;
            $inventario->preciototal = $kardexdate->saldototal;
            $inventario->save();
        } else {
            $inventario = new Inventario();
            $inventario->id_material = $request->id_material;
            $inventario->nombrematerial = $nombreMaterial;
            $inventario->cantidad = $stock->cantidad_actual;
            $inventario->unidadmedida = $unidadMaterial;
            $inventario->preciounitario = $request->precio_unitario;
            $inventario->preciototal = $kardexdate->saldototal;
            $inventario->save();

        }

    
        return redirect()->route('admin.ingresomaterial')->with('success', 'Factura y Material registrados con éxito');

    }
    public function verificarExistencia(Request $request)
    {
        // Validar el parámetro recibido
        $request->validate([
            'id_material' => 'required|exists:material,id_material',
        ]);

        // Verificar si existe en ingresodetalles
        $existe = DB::table('ingreso')->where('id_material', $request->id_material)->exists();

        // Devolver respuesta JSON
        return response()->json(['exists' => $existe]);
    }

}
