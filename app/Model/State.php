<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';
    protected $fillable = [
        'state_name_ar',
        'state_name_en',
        'country_id',
        'city_id',
    ];

    public function country_id()
    {
        //return $this->belongsTo(Country::class, 'country_id', 'id');
        return $this->hasOne('App\Model\Country', 'id', 'country_id');
    }

    public function city_id()
    {
        return $this->hasOne('App\Model\City', 'id', 'city_id');
    }

///////////////or///////////////
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function country()
    {
        //return $this->belongsTo(Country::class);
        return $this->hasOne('App\Model\Country', 'id', 'country_id');
    }
}
