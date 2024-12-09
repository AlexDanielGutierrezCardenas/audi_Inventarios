<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despachador extends Model
{
    use HasFactory;
    protected $table = 'despachador';
    protected $primaryKey = 'id_despachador';
   
    public $timestamps = false;

    protected $fillable = ['id_persona', 'turno','zona_asignada','fecha_contratacion','estado_despachador','contacto'];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
}