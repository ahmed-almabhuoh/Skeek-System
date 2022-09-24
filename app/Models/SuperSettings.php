<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperSettings extends Model
{
    use HasFactory;

    // constants
    const AR = 'Arabic';
    const EN = 'English';

    const LANGS = [SuperSettings::AR, SuperSettings::EN];
    // end constant

    public function super()
    {
        return $this->belongsTo(Super::class, 'super_id', 'id');
    }
}
