<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalidaDetalles extends Model
{
    use HasFactory;
    protected $table = 'detallesalida';
    protected $primaryKey = 'id_detalle_salida';

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
        return $this->belongsTo(Area::class, 'id_area', 'id_area');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }

    public function solicitante()
    {
        return $this->belongsTo(Solicitante::class, 'id_solicitante', 'id_solicitante');
    }

    public function despachador()
    {
        return $this->belongsTo(Despachador::class, 'id_despachador', 'id_despachador');
    }
    public function material()
    {
        return $this->belongsTo(Material::class, 'id_material', 'id_material');
    }
    public function stockMaterial()
    {
        return $this->hasOne(StockMaterial::class, 'id_detalle', 'id_detalle');
    }
}
