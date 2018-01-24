<?php

namespace App\Services;

use App\Models\UserSocial;
use App\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

class UserSocialService
{
    const PROVIDER = 'vkontakte';

    public function createOrGetUser(ProviderUser $providerUser)
    {
        $account = UserSocial::whereProvider(self::PROVIDER)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new UserSocial([
                'provider_user_id' => $providerUser->getId(),
                'provider' => self::PROVIDER
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }
}