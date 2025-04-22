<?php


namespace App\Services;


use Illuminate\Support\Facades\Http;

class SecureService
{

    public function getCountry(){
        $response = Http::get(env('API_DOMAIN').'countries');

        if ($response->successful()) {
            $data = $response->json(); // Transforme la réponse JSON en tableau PHP
            print_r($data);
        } else {
            echo 'Erreur: ' . $response->status();
        }
    }
}
