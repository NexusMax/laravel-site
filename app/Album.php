<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'photo_galleries';
    protected $fillable = array(
        'name',
        'alias',
        'description',
        'cover_image'
    );


    public function photos()
    {
        return $this->hasMany('App\Images', 'album_id', 'id');
    }
}
