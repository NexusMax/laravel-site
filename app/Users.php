<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'phone',
        'country',
        'city',
        'birthday',
        'image',
        'referal',
        'list_id',
        'mail_free'
    ];

    public function expert()
    {
        return $this->hasOne('App\Experts','user_id','id');
    }
}
