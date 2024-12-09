<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

use App\Exports\MaterialExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class MaterialController extends Controller
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
    public function adminMaterial()
    {
        $materiales = Material::all();
        return view('admin.pages.material.index',["msg"=>"Hello! I am admin"], compact('materiales'));
    }

    // Mostrar el formulario para crear un nuevo material
    public function create()
    {
        return view('admin.material.create');
    }

    // Guardar un nuevo material
    public function store(Request $request)
    {
        $request->validate([
            'codigo_material' => 'required|unique:material|max:50',
            'nombre' => 'required|max:100',
            'unidad' => 'required|max:50',
        ]);

        Material::create([
            'codigo_material' => $request->codigo_material,
            'nombre' => $request->nombre,
            'unidad' => $request->unidad,
        ]);

        return redirect()->route('admin.material')->with('success', 'Material creado correctamente.');
    }

    // Mostrar el formulario para editar un material existente
    public function edit($id)
    {
        $material = Material::findOrFail($id);
        return view('admin.material.edit', compact('material'));
    }

    // Actualizar un material existente
    public function update(Request $request, $id_material)
{
    $material = Material::findOrFail($id_material);

    $request->validate([
        'codigo_material' => 'required|max:50|unique:material,codigo_material,' . $material->id_material . ',id_material',
        'nombre' => 'required|max:100',
        'unidad' => 'required|max:50',
    ]);

    $material->update([
        'codigo_material' => $request->codigo_material,
        'nombre' => $request->nombre,
        'unidad' => $request->unidad,
    ]);

    return redirect()->route('admin.material')->with('success', 'Material actualizado correctamente.');
}


    // Eliminar un material
    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();

        return redirect()->route('admin.material')->with('success', 'Material eliminado correctamente.');
    }

    public function exportar()
    {
        return Excel::download(new MaterialExport, 'materiales.xlsx');
    }
    
    public function generateMaterialPDF()
    {
        $materiales = \App\Models\Material::all(); // Asegúrate de tener datos en la tabla Material.

        $data = [
            'materiales' => $materiales,
        ];

        $pdf = Pdf::loadView('admin.pages.reportes.pdf.materiales.index', $data)
            ->setPaper('a4', 'landscape'); // Orientación horizontal.

        return $pdf->download('reporte_materiales.pdf');
    }

}
