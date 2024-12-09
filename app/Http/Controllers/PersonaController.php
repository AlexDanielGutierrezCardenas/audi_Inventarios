<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Persona;

class PersonaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminPersona()
    {
        $personas = Persona::all();
        return view('admin.pages.persona.index',["msg"=>"Hello! I am admin"], compact('personas'));
    }

    public function create()
    {
        return view('admin.pages.persona.create'); // Retorna la vista para crear una persona
    }
    public function store(Request $request): RedirectResponse
    {
        // $persona = Persona::create($request->all());
        // return response()->json($persona);
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|string|max:255',
            'email' => 'required|email',
            'telefono' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'estado_civil' => 'required|string|max:255',
            'nacionalidad' => 'required|string|max:255',
            'numero_identificacion' => 'required|string|max:255',
        ]);

        $persona = Persona::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'genero' => $request->genero,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'estado_civil' => $request->estado_civil,
            'nacionalidad' => $request->nacionalidad,
            'numero_identificacion' => $request->numero_identificacion,
            'ocupacion' => $request->ocupacion,
        ]);
    
        $id_persona = $persona->id_persona;
        
        return redirect()->route('admin.formulario.create', ['id_persona' => $persona->id_persona]);

  
    }
    public function update(Request $request, $id) // <--- sin el tipo de retorno especificado
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
        'fecha_nacimiento' => 'required|date',
        'genero' => 'required|string|max:10',
        'email' => 'required|email|unique:personas,email,' . $id,
        'telefono' => 'required|string|max:20',
        'direccion' => 'required|string|max:255',
        'estado_civil' => 'required|string|max:20',
        'nacionalidad' => 'required|string|max:50',
        'numero_identificacion' => 'required|string|unique:personas,numero_identificacion,' . $id,
        'ocupacion' => 'required|string|max:100',
    ]);

    $persona = Persona::findOrFail($id);
    $persona->update($request->all());

    return redirect()->route('admin.persona')->with('success', 'Persona actualizada exitosamente.');

    
    }

    public function edit($id)
    {
        $persona = Persona::findOrFail($id);
        return view('admin.pages.persona.edit', compact('persona'));
    }
    public function destroy($id)
    {
        $persona = Persona::findOrFail($id);
        $persona->delete();

        return redirect()->route('admin.persona')->with('success', 'Persona eliminada exitosamente.');
    }
    public function show($id)
    {
        $persona = Persona::findOrFail($id);
        return view('admin.pages.persona.show', compact('persona'));
    }



}
