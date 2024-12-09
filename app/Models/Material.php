<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'material';
    protected $primaryKey = 'id_material';

    public $timestamps = false;

    protected $fillable = ['codigo_material', 'nombre','unidad'];

    
    public function ingresos()
    {
        return $this->hasMany(Ingreso::class);
    }
    public function detalles($id_ingreso)
    {
    
        $ingreso = Ingreso::with('detalles.material')->find($id_ingreso);

        if (!$ingreso) {
            return redirect()->back()->with('error', 'Ingreso no encontrado');
        }

        $detalles = $ingreso->detalles;

        return view('admin.pages.ingresodetalles.index', compact('detalles', 'ingreso'));
    }

}
