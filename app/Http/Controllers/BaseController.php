<?php

namespace App\Http\Controllers;

use DB;
use App\Client;
use Illuminate\Support\Facades\View;
use Session;

class BaseController extends Controller
{
    public function __construct() {
    	// $this->saveNewSession($request);
    	View::share('has_clients', $this->clients());
    }

    // protected function saveNewSession($request) {
    //     $session_id = session()->getId();
    //     $session = Client::where('session_id', $session_id)->first();

    //     if (!$session){
    //         $ip_address = $request->ip();
    //         $user_agent = $request->header('User-Agent');

    //         $client = new Client;
    //         $client->ip = $ip_address;
    //         $client->browser = $user_agent;
    //         $client->session_id = $session_id;

    //         $client->save();
    //     }
    // }

    protected function clients() {

        $clients = DB::table('clients')
            ->select(DB::raw('count(*) as client_count, browser'))
            ->groupBy('browser')
            ->get();

        return $clients;
    }
}
