<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $dates = ['fecha_emision'];
    protected $table = 'factura';
    protected $primaryKey = 'id_factura';

    public $timestamps = false;

    protected $fillable = [
        'numero_documento',
        'numero_recibo',
        'numero_factura',
        'fecha_emision',
    ];
    public function getFechaEmisionAttribute($value)
    {
        
        return Carbon::parse($value);
    }

    public function ingresos()
    {
        return $this->hasMany(Ingreso::class);
    }

}
