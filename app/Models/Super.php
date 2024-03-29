<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Super extends Authenticatable
{
    use HasFactory, HasRoles;

    public function settings()
    {
        return $this->hasOne(SuperSettings::class, 'super_id', 'id');
    }

    // Scope
    
    // End Of Scope
}
