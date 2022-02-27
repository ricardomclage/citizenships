<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'iso2',
        'iso3'
    ];

    public function userDetails()
    {
        return $this->belongsToMany(UserDetails::class, 'citizenship_country_id', 'id');
    }
}
