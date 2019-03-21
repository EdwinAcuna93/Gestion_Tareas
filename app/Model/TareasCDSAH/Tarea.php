<?php

namespace App\Model\TareasCDSAH;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Tarea extends Model
{
    protected $fillable=['tituloTarea','prioridad','descripcion','estado','fechaInicio','fechaFin','horaInicio','horaFin','users_id'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
