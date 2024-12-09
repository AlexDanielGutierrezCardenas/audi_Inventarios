<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kardexdate extends Model
{
    use HasFactory;

    protected $table = 'kardexdate';
    protected $primaryKey = 'id_kardexdate';

    public $timestamps = false;

    protected $fillable = ['detalle','id_ingreso','id_salida','id_material','cantidad_ingreso','cantidad_salida','cantidad','precio_unitario','saldoIngreso','saldoSalida','saldoTotal'];
}
