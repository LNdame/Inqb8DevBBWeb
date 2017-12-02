<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class BeerLover extends Model
{
    protected $fillable = [
        'user_id', 'status', 'date_of_birth', 'terms_conditions_accept', 'gender', 'home_city', 'referal_code', 'invitation_code', 'cocktail', 'cocktail_type', 'shot', 'shot_type', 'firebase_id',
    ];

    public function profile()
    {
        return $this->belongsTo('App\User');
    }

}
