<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    protected $fillable = [
        'name','address', 'geo_tag','liqour_license','hs_license', 'contact_person', 'contact_number','last_inspection_date', 'establishment_url', 'status'];
}
