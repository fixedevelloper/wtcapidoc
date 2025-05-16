<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatbotSession;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Gateway;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Twilio\Rest\Client;

class WhatsAppController extends Controller
{
    public function webhook(Request $request)
    {
        $from = $request->input('From');
        $body = trim($request->input('Body'));

        $session = ChatbotSession::firstOrCreate(['user_number' => $from,'is_delete'=>false]);
        $phone_number=str_replace('whatsapp:+','',$from);
        switch ($session->step) {
            case 'start':
                $session->step = 'choose_service';
                $session->save();
                return $this->reply("Bienvenue sur WTC agensic ! 💸\nQue voulez-vous faire ?\n1. Consulter le solde\n2. Transférer de l'argent\n3. Recharge du compte",$from);

            case 'choose_service':
                if ($body == '1') {
                    $session->service = 'balance';
                    $session->step = 'choose_sender';
                    $session->save();
                    return $this->reply("Quel compte voulez-vous consulter ?\n- Orange\n- MTN",$from);
                } elseif ($body == '2') {
                    $session->service = 'transfer';
                    $session->step = 'choose_sender';
                    $session->save();
                    return $this->reply("Choisissez l'expéditeur du transfert :\n- Orange\n- MTN",$from);
                } elseif ($body == '3') {
                    $session->service = 'prefunding';
                    $session->step = 'choose_country';
                    $session->save();
                    return $this->reply("Entrez le code Iso de votre pays Ex: CM pour le cameroun",$from);
                } else {
                    return $this->reply("Choix invalide. Tapez 1 ou 2 ou 3.",$from);
                }

            case 'choose_sender':
                if (!in_array(strtolower($body), ['orange', 'mtn'])) {
                    return $this->reply("Choix invalide. Tapez Orange ou MTN.",$from);
                }
                $session->sender = ucfirst(strtolower($body));
                if ($session->service == 'balance') {
                    $session->step = 'completed';
                    $session->save();
                    return $this->reply("Le solde de votre compte {$session->sender} est de 23 000 FCFA.",$from);
                } else {
                    $session->step = 'awaiting_beneficiary';
                    $session->save();
                    return $this->reply("Entrez le numéro du bénéficiaire :",$from);
                }

            case 'awaiting_beneficiary':
                $session->beneficiary = $body;
                $session->step = 'awaiting_amount';
                $session->save();
                return $this->reply("Quel montant souhaitez-vous envoyer à {$body} ?",$from);
            case 'choose_country':
                if ($body== 'exit'){
                    $session->is_delete=true;
                    $session->save();
                }
                $country=Country::query()->firstWhere(['codeIso2'=>$body]);
                if (is_null($country)){
                    $session->step = 'choose_country';
                    $session->save();
                    return $this->reply('Pays introuve, veillez entrer un code iso du pays correct ou exit pour sortir',$from);
                }
                $session->country_code = $body;
                $session->step = 'awaiting_amount_prefunding';
                $session->save();
                return $this->reply("Quel montant souhaitez-vous ajouter à votre compte ?",$from);
            case 'awaiting_amount_prefunding':
                if (!is_numeric($body)) {
                    return $this->reply("Montant invalide.",$from);
                }
                $session->amount = $body;
                $session->step = 'choose_operator_prefunding';
                $session->save();
                $country=Country::query()->firstWhere(['codeIso2'=>$session->country_code]);
                $geteways=Gateway::query()->where(['method' => $country->code_gateway_mobil, 'country_id' => $country->id])->get(['id','name']);
                $msg="Choisissez l'operateur de la transaction :\n";
                foreach ($geteways as $index => $element) {
                    if ($index > 0) {
                        $msg .= "\n"; // Ajoute une virgule et un espace entre les éléments
                    }
                    $msg .= $element->id.'-'.$element->name;
                }
                return $this->reply($msg,$from);
            case 'choose_operator_prefunding':
                $geteways=Gateway::query()->find($body);
                if (is_null($geteways)) {
                    return $this->reply("Choix invalide. Tapez de nouveau.",$from);
                }else{
                    $session->gateway = ucfirst(strtolower($body));
                    $session->step = 'password_prefunding';
                    $session->save();
                    //$this->sendOtp($from);
                    return $this->reply("Entrez votre mot de passe.",$from);
                }
            case 'password_prefunding':
                if ($body== 'exit'){
                    $session->is_delete=true;
                    $session->save();
                }
                $customer=Customer::query()->firstWhere(['phone'=>$phone_number]);
                if (is_null($customer)){
                    $session->is_delete=true;
                    $session->save();
                    return $this->reply("Compte invalide. Allez au menu",$from);
                }
                if (!Auth::attempt(['email' => $customer->user->email, 'password' => $body])) {
                    return $this->reply("Mot de passe invalide. Tapez de nouveau.",$from);
                }else{
                    $session->beneficiary = $customer->id;
                    $session->step = 'awaiting_otp_prefunding';
                    $session->save();
                    return $this->reply("La transaction a été initieé vers ce Numero. Veuillez confirmer la recharge.",$from);
                }
            case 'awaiting_otp_prefunding':
                $gateway=Gateway::query()->find($session->gateway);
                $msg = "Recharge de {$session->amount} FCFA via {$gateway->name} effectué.";
                $session->is_delete=true;
                $session->save();
                return $this->reply($msg,$from);
            case 'awaiting_amount':
                if (!is_numeric($body)) {
                    return $this->reply("Montant invalide.",$from);
                }
                $session->amount = $body;
                $session->step = 'awaiting_otp';
                $session->save();
                //$this->sendOtp($from);
                return $this->reply("Un OTP vous a été envoyé. Veuillez le saisir pour confirmer le transfert.",$from);

            case 'awaiting_otp':
             /*   if ($this->verifyOtp($from, $body)) {
                    $msg = "Transfert de {$session->amount} FCFA à {$session->beneficiary} via {$session->sender} effectué.";
                    $session->delete(); // reset
                    return $this->reply($msg);
                } else {
                    return $this->reply("OTP invalide. Veuillez réessayer.");
                }*/
                $msg = "Transfert de {$session->amount} FCFA à {$session->beneficiary} via {$session->sender} effectué.";
                $session->is_delete=true;
                $session->save();
                return $this->reply($msg,$from);
            default:
                $session->step = 'start';
                $session->save();
                return $this->reply("Redémarrage du menu... 💸\nEntrez une touche pour recommencer",$from);
        }
    }

    private function reply($msg,$to)
    {
       /* return response("<Response><Message>{$msg}</Message></Response>", 200)
            ->header('Content-Type', 'text/xml');*/
       // return response($msg, 200);
        $this->sendMessage($to,$msg);
    }

    private function sendOtp($to)
    {
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
        $twilio->verify->v2->services(env('TWILIO_VERIFY_SID'))
            ->verifications
            ->create($to, 'whatsapp');
    }

    private function verifyOtp($to, $code)
    {
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
        $check = $twilio->verify->v2->services(env('TWILIO_VERIFY_SID'))
            ->verificationChecks
            ->create(['to' => $to, 'code' => $code]);

        return $check->status === 'approved';
    }
    public function webhook1(Request $request)
    {
        $user_data = [
            'name' => 'bob',
            'beneficiare' => ['Alice', 'Bob'],
            'solde' => 15000
        ];
        $from = $request->input('From');
        $body = strtolower(trim($request->input('Body')));
        $session = Session::get($from, ['state' => 'menu']);
        logger($session['state']);
        if ($body=='menu'){
            $response = "👋 Bonjour ! Bienvenue sur WTC agensic 💸\n " . "Que souhaitez-vous faire aujourd’hui? \n";
            $response .= "1️⃣ Voir solde\n2️⃣ Envoyer argent\n3️⃣ Historique";
        }

        elseif ($session['state'] === 'menu') {
            if ($body === '1') {
                $response = "💰 Votre solde est de 10 000 FCFA.";
            } elseif ($body === '2') {
                Session::put($from, ['state'=>'choix_beneficiaire']);

                $sessionb=Session::get($from);
               $session['state']=$sessionb['state'];
                //logger(Session::get($from));
                $response = "À qui souhaitez-vous envoyer de l'argent ?\n- Alice\n- Bob\n- Ajouter un nouveau \n";
            } elseif ($body === '3') {
                $response = '📄 Historique :\n- 5000 FCFA à Alice\n- 2000 FCFA à Bob';
            } else {
                $response = "❓ Choix invalide. Tapez *menu* pour recommencer.";
            }
        } elseif ($session['state'] === 'choix_beneficiaire') {

            if (in_array($body, $user_data['beneficiare'])) {
                $session["beneficiaire"] = $body;
                Session::put($from, ['state'=>'choix_montant']);
                $ben = $session["beneficiaire"];
                $response = "Quel montant voulez-vous envoyer à " . $ben . " ?\n- 1000\n- 5000\n- Autre montant";
            } else {
                $response = "❌ Bénéficiaire non reconnu. Essayez : Alice ou Bob.";
            }
        } elseif ($session['state'] == 'choix_montant') {
            $montant = intval($body);
            if ($montant > $user_data["solde"]) {
                $response = "❌ Solde insuffisant.";
            } else {
                $user_data["solde"] -= $montant;
                $response = "✅ {montant} FCFA envoyés à {session['beneficiaire']}.\nNouveau solde : {USER_DATA['solde']} FCFA.";
                $session["state"] = "menu";
            }

        }
        Session::put($from, $session);
        /*     if (in_array($body, ['menu', 'bonjour', 'salut'])) {
                 $response .= "1️⃣ Voir solde\n2️⃣ Envoyer argent\n3️⃣ Historique";
             } elseif ($body === '1') {
                 $response = "💰 Votre solde est de 10 000 FCFA.";
             } elseif ($body === '2') {
                 $response = "Entrez le numéro du destinataire.";
             } elseif ($body === '3') {
                 $response = "📜 Historique: 5000 FCFA envoyés à Alice.";
             } else {
                 $response = "Commande non reconnue. Envoyez 'menu' pour recommencer.";
             }*/

        //$this->sendMessage($from, $response);
        return response($response, 200);
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
