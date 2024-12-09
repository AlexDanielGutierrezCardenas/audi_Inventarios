<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    
    protected $table = 'persona';
    protected $primaryKey = 'id_persona';

    public $timestamps = false;

    protected $fillable = ['nombre', 'apellido','fecha_nacimiento','genero','email','telefono','direccion','estado_civil','nacionalidad','numero_identificacion','ocupacion'];

    public function solicitante()
    {
        return $this->hasOne(Solicitante::class, 'id_persona');
    }

    public function despachador()
    {
        return $this->hasOne(Despachador::class, 'id_persona');
    }

}
