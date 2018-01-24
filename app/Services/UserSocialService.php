<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Ad;
use App\Models\UserSocial;
use App\User;
use ATehnix\VkClient\Client;
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
                'provider' => self::PROVIDER,
                'access_token' => $providerUser->token
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {

                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name' => $providerUser->getName(),
                    'photo' => $providerUser->avatar
                ]);
            }

            $account->user()->associate($user);
            $account->save();

            $this->seedAccounts($providerUser->token);

            return $user;
        }
    }

    protected function seedAccounts($token)
    {
        $api = new Client;
        $api->setDefaultToken($token);

        $response = $api->request('ads.getAccounts');

        foreach ($response['response'] as $account) {
            Account::forceCreate([
                'id' => $account['account_id'],
                'type' => $account['account_type'],
                'status' => $account['account_status'],
                'name' => $account['account_name'],
                'role' => $account['access_role'],
            ]);

            if($account['account_type'] === 'general'){
                $this->seedAds($token, $account['account_id']);
            }
        }
    }

    protected function seedAds($token, $id)
    {
        $api = new Client;
        $api->setDefaultToken($token);

        $response = $api->request('ads.getAds', [
            'account_id' => $id
        ]);

        foreach ($response['response'] as $ad) {
            Ad::forceCreate(array_merge($ad, ['account_id' => $id]));
        }
    }
}