<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logging extends Model
{
    protected $table = 'log';
    protected $fillable = [
        'action', 'object_id', 'email', 'json'
    ];
}
