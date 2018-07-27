<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experts extends Model
{
    protected $table = 'experts';

    protected $fillable = [
        'body',
        'meta_title',
        'meta_desc',
        'user_id',
        'group_id',
        'active',
        'link_fb',
        'link_in',
        'position',
    ];

    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }

    public function userWithItems()
    {
        return $this->hasOne('App\User','id','user_id')->with('items');
    }

    public function category()
    {
        return $this->hasOne('App\ExpertsGroup','id','group_id');
    }
}
