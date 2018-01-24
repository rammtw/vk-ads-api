<?php

namespace App\Http\Controllers\Ads;

use App\Models\Account;
use App\Models\Ad;
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
        $cabs = Account::all();

        return view('ads.cab.index', compact('cabs'));
    }

    public function show(Account $account)
    {
        $ads = $account->ads;

        return view('ads.cab.show', compact('ads', 'account'));
    }

    public function adShow(Account $account, Ad $ad)
    {
        return view('ads.cab.ad_show', compact('ad', 'account'));
    }
}
