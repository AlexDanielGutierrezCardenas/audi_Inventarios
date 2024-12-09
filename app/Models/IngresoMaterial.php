<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresoMaterial extends Model
{
    use HasFactory;
    protected $table = 'ingreso';
    protected $primaryKey = 'id_ingreso';

    public $timestamps = false;

    protected $fillable = [
        'id_proveedor',
        'id_factura',
        'ndocumento',
        'cantidad',
        'precio_unitario',
        'precio_total',
    ];

    
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    
    public function factura()
    {
        return $this->belongsTo(Factura::class, 'id_factura');
    }


    public function material()
    {
        return $this->belongsTo(Material::class, 'id_material');
    }
    public function detalles()
    {
        return $this->hasMany(IngresoDetalle::class, 'id_ingreso', 'id_ingreso');
    }

}
