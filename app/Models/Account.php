<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public function ads()
    {
        return $this->hasMany(Ad::class);
    }
}
