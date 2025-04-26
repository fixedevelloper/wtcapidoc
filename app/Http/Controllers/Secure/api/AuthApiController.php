<?php


namespace App\Http\Controllers\Secure\api;


use App\Models\Customer;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;

class AuthApiController
{

    public function login(Request $request)
    {
        $privateKey = file_get_contents('private.pem');
        $request->validate([
            'private_key' => 'required|string',
            'secret_key' => 'required|string',
        ]);

        // Vérifie si un customer correspond à ces credentials
        $customer = Customer::where('wtc_private_key', $request->private_key)
            ->where('wtc_secret_key', $request->secret_key)
            ->first();

        if (! $customer) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        // Génère un JWT signé avec SA clé privée
        $payload = [
            'iss' => 'wtc_api',
            'sub' => $customer->id,
            'iat' => time(),
            'exp' => time() + 3600
        ];

        $jwt = JWT::encode($payload, $privateKey, 'RS256');

        return response()->json([
            'access_token' => $jwt,
            'token_type' => 'bearer',
            'expires_in' => 3600
        ]);
    }
}
