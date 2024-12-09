<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    use HasFactory;
    protected $table = 'solicitante';
    protected $primaryKey = 'id_solicitante';

    public $timestamps = false;

    protected $fillable = ['id_persona', 'estado_solicitud','fecha_solicitud','tiposolicitud'];
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'id_persona');
    }
}