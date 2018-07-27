<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Shared extends Model
{
    protected $table = 'sp_shared';
    protected $fillable = ['post_id', 'user_id', 'social'];
    

    public static function getShared($post_id)
    {
        $shared = DB::table('sp_shared')->select(DB::raw('count(*) as count, social'))->where('post_id', $post_id)->groupBy('social')->get();

        return $shared;
    }

    public static function getCount($social, $shared)
    {
        foreach ($shared as $key)
            if( $social == $key->social )
                return $key->count;
        return 0;
    }
}
