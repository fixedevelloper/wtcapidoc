<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Customer;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class VerifyCustomerJwt
{
    public function handle(Request $request, Closure $next)
    {
        $privateKey = file_get_contents('private.pem');
        $publicKey = file_get_contents('public.pem');
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        $token = trim(str_replace('Bearer', '', $authHeader));

        try {
            // Décodage non vérifié pour extraire customer_id
            $payload = json_decode(base64_decode(explode('.', $token)[1]), true);
            $customerId = $payload['sub'] ?? null;

            if (!$customerId) {
                throw new Exception('Invalid token payload');
            }

            $customer = Customer::find($customerId);

            if (! $customer || ! $publicKey) {
                throw new Exception('Customer not found or missing public key');
            }

            // Vérification du token avec la clé publique
            $decoded = JWT::decode($token, new Key($publicKey, 'RS256'));

            // Injecter le customer dans la requête
            $request->merge(['customer' => $customer]);

        } catch (Exception $e) {
            return response()->json(['error' => 'Invalid token: ' . $e->getMessage()], 401);
        }

        return $next($request);
    }
}
