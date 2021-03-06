<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    protected $fillable = [
        'name', 'address', 'user_name', 'password', 'longitude', 'creator_id', 'latitude', 'liqour_license', 'main_picture_url', 'picture_2', 'picture_3', 'hs_license', 'contact_person', 'contact_number', 'last_inspection_date', 'establishment_url', 'status'];

    public function promotions()
    {
        return $this->hasMany('App\Promotion');
    }
}
