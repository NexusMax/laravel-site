<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';


    public function roleName()
    {
        return $this->hasOne('App\Roles', 'id', 'role_id');
    }
}
