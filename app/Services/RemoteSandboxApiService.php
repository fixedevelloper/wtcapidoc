<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class RemoteSandboxApiService
{
    private $base_url;

    /**
     * SecureController constructor.
     */
    public function __construct()
    {
        $this->base_url=config('app.API_DOMAINCONFIG').'api_sandbox';
    }



    public function getToken()
    {
        return Cache::remember('remote_api_token', 60 * 60, function ()  {
            return $this->login(session('email'),session('password'));
        });
    }

    public function login($email, $password)
    {
        $response = Http::post("$this->base_url/wtc_login_partners", [
            'email' => $email,
            'password' => $password,
            'mode'=>session('mode')
        ]);
        logger($response);
        if ($response->successful()) {
            $token = $response->json()['data']['wtc_key'] ?? null;
            session(['email' => $email]);
            session(['password' => $password]);
            // On peut le stocker en cache avec une clé personnalisée
            if ($token) {
                Cache::put("remote_api_token", $token, now()->addHour());
            }

            return $token;
        }

        return null;
    }

    public function get($endpoint,$params=[])
    {
        $token = $this->getToken();
        $headers=[ 'wtc-key' => $token,
            'Accept' => 'application/json',];

        $fusion = array_merge($headers, $params);
        return Http::withHeaders($fusion)->timeout(20)->get("$this->base_url/$endpoint");
    }

    public function post($endpoint, array $data)
    {
        $token = $this->getToken();

        return Http::withHeaders([
        'wtc-key' => $token,
        'Accept' => 'application/json',
    ])->post("$this->base_url/$endpoint", $data);
    }

    public function clearToken()
    {
        Cache::forget('remote_api_token');
        Session::forget(['mode','email','password']);
    }
}
