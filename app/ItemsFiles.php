<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemsFiles extends Model
{
    protected $table = 'sp_items_files';

    protected $fillable = [
        'item_id',
        'path',
        'type_file',
    ];

    public function getTypeFile()
    {
        return [
            'book', //0
            'tutorials', //1
            'paper', //2
            'benefits' //3
        ];
    }
}
