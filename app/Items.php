<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;


class Items extends Model
{
    use Sortable;


    public $sortable = ['created_at'];

    protected $table = 'sp_items';

    protected $fillable = [
        'name',
        'category_id',
        'intro',
        'alias',
        'description',
        'fulltext',
        'author_id',
        'edited_user_id',
        'published',
        'img',
        'video',
        'gallery_id',
        'featured',
        'users_id',
        'icons',
        'type',
        'role_id',
        'views',
        'user_type',
        'is_type',
        'created_at'
    ];


    public function category()
    {
        return $this->hasOne('App\Categories', 'id', 'category_id');
    }

    public function user()
    {
        return $this->hasOne('App\Users', 'id', 'author_id');
    }

    public function files()
    {
        return $this->hasMany('App\ItemsFiles', 'item_id', 'id');
    }

    public function gallery()
    {
        return $this->hasOne('App\Album', 'id', 'gallery_id')->with('photos');
    }

    public static function getNamePermission($number = null)
    {
        $str = '';
        switch($number)
        {
            case 'private': $str = 'Премиум контент'; break;
            default: $str = 'Общий доступ';
        }
        return $str;
    }

    public static function isPrivate($type)
    {
        return $type === 'private' ? true : false;
    }
}
