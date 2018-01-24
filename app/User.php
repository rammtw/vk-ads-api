<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function createBySocialProvider($providerUser, $providerName)
    {
        if(isset($providerUser->user['first_name']) || isset($providerUser->user['last_name'])) {
            $firstName = $providerUser->user['first_name'];
            $lastName = $providerUser->user['last_name'];
        } else {
            $fullName = explode(' ', $providerUser->getName());
            $firstName = $fullName[0];
            $lastName = $fullName[1];
        }

        $email = UserSocialService::getMail($providerUser);

        return self::create([
            'email' => $email,
            'name' => $firstName,
            'last_name' => $lastName,
            'password' => bcrypt(Carbon::now())
        ]);
    }
}
