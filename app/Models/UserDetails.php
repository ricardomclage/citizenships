<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;

class UserDetails extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'citizenship_country_id',
        'first_name',
        'last_name',
        'phone_number'
    ];

    public function citizenshipCountry()
    {
        return $this->hasOne(Country::class, 'id', 'citizenship_country_id');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
