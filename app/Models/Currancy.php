<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currancy extends Model
{
    use HasFactory;

    public function getCurrancyStatusAttribute()
    {
        return $this->active ? 'Active' : 'In-active';
    }

    public function sheeks () {
        return $this->hasMany(Sheek::class);
    }
}
