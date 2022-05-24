<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function banks () {
        return $this->hasMany(Bank::class, 'country_id', 'id');
    }

    public function admins () {
        return $this->hasMany(Admin::class, 'county_id', 'id');
    }

    public function getActiveStatusAttribute () {
        return $this->active ? 'Active' : 'In-active';
    }
}
