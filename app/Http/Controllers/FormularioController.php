<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

use App\Models\Despachador;
use App\Models\Solicitante;
use Illuminate\Http\RedirectResponse;


class FormularioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       /*/*/
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
        $id_persona = $request->query('id_persona');

        // Buscar la persona con el ID proporcionado
        $persona = Persona::find($id_persona);

        // Verificar si la persona existe
        if (!$persona) {
            return redirect()->back()->withErrors('Persona no encontrada');
        }

        // Retornar la vista con la persona
        return view('admin.pages.formulario.create', compact('persona','id_persona'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'table' => 'required|in:despachador,solicitante',
        ]);

        switch ($validated['table']) {

            case 'despachador':
                // Validar los datos del despachador
                $validatedData = $request->validate([
                    'id_persona' => 'required|integer',
                    'turno' => 'required|string|max:255',
                    'zona_asignada' => 'required|string|max:255',
                    'fecha_contratacion' => 'required|date',
                    'estado_despachador' => 'required|string|max:255',
                    'contacto' => 'required|string|max:255',
                ]);
                $despachador = Despachador::create($validatedData);
            
                $id_despachador = $despachador->id_despachador; 
                return redirect()->route('admin.despachador', ['id_despachador' => $id_despachador]);
                break;
            case 'solicitante':
                // Validar los datos del despachador
                $validatedData = $request->validate([
                    'id_persona' => 'required|integer',
                    'estado_solicitud' => 'required|string|max:255',
                    'fecha_solicitud' => 'required|date',
                    'tipo_solicitud' => 'required|string|max:255',
                ]);
                $solicitante = Solicitante::create($validatedData);

                $id_solicitante = $solicitante->id_solicitante;  
                return redirect()->route('admin.solicitante')->with('success', 'Persona eliminada exitosamente.');
                break;
        }

        return redirect()->back()->with('success', 'Registro creado exitosamente en la tabla ' . $validated['table']);
    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
