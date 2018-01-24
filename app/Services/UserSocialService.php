<?php

namespace App;

use App\Models\UserSocial;

class UserSocialService
{
    public function createOrGetUser($providerObj, $providerName)
    {
        $providerUser = $providerObj->user();

        $account = UserSocial::whereProvider($providerName)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {
            $email = $this->getMail($providerUser, $providerName);

            $account = new UserSocial([
                'provider_user_id' => $providerUser->getId(),
                'provider'         => $providerName
            ]);

            $user = User::whereEmail($email)->first();

            if (!$user) {
                $user = User::createBySocialProvider($providerUser, $providerName);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;
        }
    }

    public static function getMail($providerUser)
    {
        $email = $providerUser->getEmail() ? $providerUser->getEmail() : $providerUser->getId() . '@vk.com';

        return $email;
    }
}