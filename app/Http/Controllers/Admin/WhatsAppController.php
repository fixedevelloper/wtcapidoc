<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class WhatsAppController extends Controller
{
    public function webhook(Request $request)
    {
        $from = $request->input('From');
        $body = strtolower(trim($request->input('Body')));

        $response = "Bienvenue sur MoneyBot 💸\n";
        if (in_array($body, ['menu', 'bonjour', 'salut'])) {
            $response .= "1️⃣ Voir solde\n2️⃣ Envoyer argent\n3️⃣ Historique";
        } elseif ($body === '1') {
            $response = "💰 Votre solde est de 10 000 FCFA.";
        } elseif ($body === '2') {
            $response = "Entrez le numéro du destinataire.";
        } elseif ($body === '3') {
            $response = "📜 Historique: 5000 FCFA envoyés à Alice.";
        } else {
            $response = "Commande non reconnue. Envoyez 'menu' pour recommencer.";
        }

        $this->sendMessage($from, $response);
        return response('OK', 200);
    }

    private function sendMessage($to, $message)
    {
        $sid = config('app.TWILIO_ACCOUNT_SID');
        $token = config('app.TWILIO_AUTH_TOKEN');
        $from = config('app.TWILIO_WHATSAPP_NUMBER');

        $client = new Client($sid, $token);
        $client->messages->create($to, [
            'from' => $from,
            'body' => $message,
        ]);
    }
}
