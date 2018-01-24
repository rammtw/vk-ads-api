<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserSocial extends Model
{
    protected $table = 'user_social';

    protected $fillable = ['user_id', 'provider_user_id', 'provider', 'access_token'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
