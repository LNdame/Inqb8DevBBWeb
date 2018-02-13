<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'start_date', 'end_date', 'status', 'description', 'main_picture_url', 'picture_2', 'picture_3', 'contact_person', 'contact_number', 'latitude', 'longitude', 'event_url', 'address'
    ];
}
