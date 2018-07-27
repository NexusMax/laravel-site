<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventsOrder extends Model
{
    protected $table = 'events_order';

    protected $fillable = [
        'event_id',
        'email',
        'user_id',
        'price',
        'created_at',
        'updated_at'
    ];





}
