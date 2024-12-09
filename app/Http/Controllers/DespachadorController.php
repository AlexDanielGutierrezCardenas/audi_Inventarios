<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Despachador;

class DespachadorController extends Controller
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
    public function adminDespachador()
    {
        $despachadores = Despachador::all();
        return view('admin.pages.despachador.index',["msg"=>"Hello! I am admin"], compact('despachadores'));
    }
        // Mostrar el formulario de edición
        public function edit($id)
        {
            $despachador = Despachador::findOrFail($id); // Buscar el despachador por su ID
            return view('admin.pages.despachador.edit', compact('despachador')); // Vista para editar el despachador
        }
    
        // Actualizar un despachador existente
        public function update(Request $request, $id)
        {
            $request->validate([
                'turno' => 'required|string',
                'zona_asignada' => 'required|string',
                'fecha_contratacion' => 'required|date',
                'estado_despachador' => 'required|string',
                'contacto' => 'required|string',
            ]);
    
            $despachador = Despachador::findOrFail($id);
            $despachador->update([
                'turno' => $request->turno,
                'zona_asignada' => $request->zona_asignada,
                'fecha_contratacion' => $request->fecha_contratacion,
                'estado_despachador' => $request->estado_despachador,
                'contacto' => $request->contacto,
            ]);
    
            return redirect()->route('admin.despachador')->with('success', 'Despachador actualizado exitosamente.');
        }
    
        // Eliminar un despachador
        public function destroy($id)
        {
            $despachador = Despachador::findOrFail($id);
            $despachador->delete();
    
            return redirect()->route('admin.despachador')->with('success', 'Despachador eliminado exitosamente.');
        }
}
