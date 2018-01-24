<?php

namespace App\Http\Controllers\Ads;

use ATehnix\VkClient\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CabController extends Controller
{
    protected $api;

    public function __construct(Client $api)
    {
        $this->middleware('auth');
        $this->api = $api;
    }

    public function index()
    {
        $this->api->setDefaultToken(auth()->user()->social->access_token);

        $response = $this->api->request('ads.getAccounts');

        return view('ads.cab.index', ['cabs' => $response['response']]);
    }

    public function show($id)
    {
        $this->api->setDefaultToken(auth()->user()->social->access_token);

        $response = $this->api->request('ads.getAds', [
            'account_id' => $id
        ]);

        return view('ads.cab.show', ['ads' => $response['response']]);
    }

    public function adShow()
    {

    }
}
