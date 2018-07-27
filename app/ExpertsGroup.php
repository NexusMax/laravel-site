<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpertsGroup extends Model
{
    protected $table = 'experts_group';

    protected $fillable = [
        'name',
        'meta_title',
        'meta_desc',
        'active',
        'alias',
    ];
}
