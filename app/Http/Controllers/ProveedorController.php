<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;

class ProveedorController extends Controller
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
    public function adminProveedor()
    {
        $proveedores = Proveedor::all();
        return view('admin.pages.proveedor.index',["msg"=>"Hello! I am admin"], compact('proveedores'));
    }

    // Método para mostrar el formulario de creación de un nuevo proveedor
    public function create()
    {
        return view('admin.pages.proveedor.create');
    }

    // Método para almacenar un nuevo proveedor en la base de datos
    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:proveedoraqui|max:10',
            'nombre_proveedor' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'nit' => 'required|string|max:20',
            'telefono' => 'nullable|string|max:15',
        ]);

        Proveedor::create($request->all());

        return redirect()->route('admin.proveedor')->with('success', 'Proveedor creado con éxito.');
    }

    // Método para mostrar los detalles de un proveedor específico
    public function show($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('admin.pages.proveedor.show', compact('proveedor'));
    }

    // Método para mostrar el formulario de edición de un proveedor
    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('admin.pages.proveedor.edit', compact('proveedor'));
    }

    // Método para actualizar un proveedor existente en la base de datos
    public function update(Request $request, $id)
{
    // Obtener el proveedor antes de la validación
    $proveedor = Proveedor::findOrFail($id);

    // Validar los datos de entrada
    $request->validate([
        'codigo' => 'unique:proveedoraqui,codigo,' . $proveedor->id_proveedor . ',id_proveedor',
        'nombre_proveedor' => 'required|string|max:255',
        'direccion' => 'nullable|string|max:255',
        'nit' => 'required|string|max:20',
        'telefono' => 'nullable|string|max:15',
    ]);

    // Actualizar el proveedor
    $proveedor->update($request->all());

    return redirect()->route('admin.proveedor')->with('success', 'Proveedor actualizado con éxito.');
}


    // Método para eliminar un proveedor de la base de datos
    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();

        return redirect()->route('admin.proveedor')->with('success', 'Proveedor eliminado con éxito.');
    }
}
