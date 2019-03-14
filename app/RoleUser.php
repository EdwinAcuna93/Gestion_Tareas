<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    //
    protected $table = 'role_user';

    public function roles()
    {
        return $this->belongsTo('App\Role');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
