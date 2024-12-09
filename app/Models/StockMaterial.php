<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IngresoDetalles;

class StockMaterial extends Model
{
    use HasFactory;
    protected $table = 'stockmaterial';
    protected $primaryKey = 'id_stock';

    public $timestamps = false;

    protected $fillable = [
        'id_ingreso',
        'cantidad_actual',
        'estado',
    ];

    public function ingresoDetalle()
    {
        return $this->belongsTo(IngresoDetalles::class, 'id_detalle', 'id_detalle');
    }
}
