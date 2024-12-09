<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalidaMaterial extends Model
{
    use HasFactory;
    protected $table = 'salida';
    protected $primaryKey = 'id_salida';

    public $timestamps = false;

    protected $fillable = [
        'id_area',
        'id_proveedor',
        'id_solicitante',
        'id_despachador',
        'id_material',
        'cantidad',
        'precio_unitario',
        'precio_total',
    ];
    public function area()
    {
        return $this->belongsTo(Area::class, 'id_area');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    public function solicitante()
    {
        return $this->belongsTo(Solicitante::class, 'id_solicitante');
    }

    public function despachador()
    {
        return $this->belongsTo(Despachador::class, 'id_despachador');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'id_material');
    }
}
