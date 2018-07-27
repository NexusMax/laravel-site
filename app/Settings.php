<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'sp_settings';
    protected $fillable = [
        'param',
        'value'
    ];
}
