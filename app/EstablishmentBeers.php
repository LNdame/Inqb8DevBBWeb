<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstablishmentBeers extends Model
{
    //
    protected $fillable = ['name', 'description', 'vendor', 'percentage', 'creator_id'];
}
