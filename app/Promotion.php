<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'title', 'start_date', 'end_date', 'status', 'price', 'establishment_id', 'beer_id'
    ];
}
