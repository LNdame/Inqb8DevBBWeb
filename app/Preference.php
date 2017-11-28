<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $fillable = [
        'beer_lover_id', 'beer_id', 'status'
    ];

    public function user()
    {

    }
}
