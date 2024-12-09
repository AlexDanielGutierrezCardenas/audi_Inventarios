<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitante;

class SolicitanteController extends Controller
{
    public function adminSolicitante()
    {
        $solicitantes = Solicitante::all();
        return view('admin.pages.solicitante.index',["msg"=>"Hello! I am admin"], compact('solicitantes'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'estado_solicitud' => 'required|string|max:255',
            'fecha_solicitud' => 'required|date',
            'tiposolicitud' => 'required|string|max:255',
        ]);

        Solicitante::create($validated);

        return redirect()->route('admin.solicitante.index')
                         ->with('success', '¡Solicitante creado con éxito!');
    }

    // Método para mostrar un solicitante específico
    public function show($id)
    {
        $solicitante = Solicitante::findOrFail($id);
        return view('admin.pages.solicitante.show', compact('solicitante'));
    }

    // Método para mostrar el formulario de edición
    public function edit($id)
    {
        $solicitante = Solicitante::findOrFail($id);
        return view('admin.pages.solicitante.edit', compact('solicitante'));
    }

    // Método para actualizar un solicitante
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'estado_solicitud' => 'required|string|max:255',
            'fecha_solicitud' => 'required|date',
            'tiposolicitud' => 'required|string|max:255',
        ]);

        $solicitante = Solicitante::findOrFail($id);
        $solicitante->update($validated);

        return redirect()->route('admin.solicitante')
                         ->with('success', '¡Solicitante actualizado con éxito!');
    }

    // Método para eliminar un solicitante
    public function destroy($id)
    {
        $solicitante = Solicitante::findOrFail($id);
        $solicitante->delete();

        return redirect()->route('admin.solicitante')
                         ->with('success', '¡Solicitante eliminado con éxito!');
    }

    public function toggleEstado(Request $request, $id)
    {
        $solicitante = Solicitante::findOrFail($id);
    
        // Cambiar el estado
        $nuevoEstado = $solicitante->estado_solicitud === 'activo' ? 'inactivo' : 'activo';
        $solicitante->estado_solicitud = $nuevoEstado;
        $solicitante->save();
    
        return response()->json([
            'success' => true,
            'nuevoEstado' => $nuevoEstado,
        ]);
    }
    

}
