<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresoDetalles extends Model
{
    use HasFactory;
    protected $table = 'ingresodetalles';
    protected $primaryKey = 'id_detalle';

    public $timestamps = false;


    protected $fillable = [
        'id_ingreso',
        'nombrematerial',
        'unidadmedida',
        'cantidad',
        'preciounitario',
        'preciototal',
    ];

    public function ingreso()
    {
        return $this->belongsTo(Ingreso::class, 'id_ingreso', 'id_ingreso');
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
