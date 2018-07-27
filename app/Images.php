<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'photo_images';
    protected $fillable = array(
        'album_id',
        'description',
        'image'
    );

}
