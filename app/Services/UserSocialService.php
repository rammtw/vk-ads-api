<?php

namespace App\Services;

use App\Models\Account;
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

            $this->seedAccounts();
            $this->seedAds('1603914592');

            return $user;
        }
    }

    protected function seedAccounts()
    {
        $api = new Client;
        $api->setDefaultToken(auth()->user()->social->access_token);

        $response = $api->request('ads.getAccounts');

        foreach ($response['response'] as $account) {
            Account::forceCreate([
                'id' => $account['account_id'],
                'type' => $account['account_type'],
                'status' => $account['account_status'],
                'name' => $account['account_name'],
                'role' => $account['account_role'],
            ]);
        }
    }

    protected function seedAds($id)
    {
        $api = new Client;
        $api->setDefaultToken(auth()->user()->social->access_token);

        $response = $api->request('ads.getAds', [
            'account_id' => $id
        ]);

        foreach ($response['response'] as $ad) {
            Account::forceCreate($ad);
        }
    }
}