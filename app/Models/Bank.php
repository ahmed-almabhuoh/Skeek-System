<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    public function sheekImage()
    {
        return $this->hasOne(SheekImage::class, 'bank_id', 'id');
    }
}
