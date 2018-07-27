<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscribes extends Model
{
    protected $table = 'sp_subscribes';
    protected $fillable = [
        'name', 'message', 'active'
    ];
}
