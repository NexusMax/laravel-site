<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'sp_categories';
    protected $fillable = [
        'name',
        'alias',
        'published',
        'about',
        'dt',
        'title',
        'description',
        'settings',
        'featured',
        'img',
        'icon',
        'icon_hover',
        'icon_3',
        'icon_mini',
        'icon_mini_2',
        'name_article',
        'name_briefcases',
        'is_video',
    ];

    public function items()
    {
        return $this->hasMany('App\Items', 'category_id', 'id')->with('user');
    }
}
