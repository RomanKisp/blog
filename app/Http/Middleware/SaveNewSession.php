<?php

namespace App\Http\Middleware;

use Closure;
use App\Client;

class SaveNewSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $session_id = session()->getId();
        $session = Client::where('session_id', $session_id)->first();

        if (!$session){
            $ip_address = $request->ip();
            $user_agent = $request->header('User-Agent');

            $client = new Client;
            $client->ip = $ip_address;
            $client->browser = $user_agent;
            $client->session_id = $session_id;

            $client->save();
        }

        return $next($request);
    }
}
