<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class ItemsEvents extends Model
{
    use Sortable;

    protected $table = 'sp_items_events';
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
        'end_at',
        'created_at',
        'vimeo',
        'price',
        'count_people',
        'spiker',
        'without_date',
        'old_price',
    ];

}
