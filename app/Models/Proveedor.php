<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    
    protected $table = 'proveedoraqui';
    protected $primaryKey = 'id_proveedor';

    public $timestamps = false;

    protected $fillable = ['codigo', 'nombre_proveedor','direccion','nit','telefono'];

    public function ingresos()
    {
        return $this->hasMany(Ingreso::class);
    }


}
