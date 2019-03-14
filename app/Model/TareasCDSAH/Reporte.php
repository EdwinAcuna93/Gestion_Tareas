<?php

namespace App\Model\TareasCDSAH;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    //
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
