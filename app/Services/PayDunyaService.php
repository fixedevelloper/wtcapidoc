<?php


namespace App\Services;


use App\Models\Transaction;

class PayDunyaService
{
    protected $base_url;

    /**
     * PayDunyaService constructor.
     * @param $base_url
     */
    public function __construct($base_url)
    {
        $this->base_url = $base_url;
    }

    public function make_transfert($item)
    {
        logger()->error('*******************************************************************************************');
        $transaction_numero = '';
        $allowed_characters = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'f');
        for ($i = 1; $i <= 8; $i++) {
            $transaction_numero .= $allowed_characters[rand(0, count($allowed_characters) - 1)];
        }
        $data=[
            'account_alias'=>$item['phone'],
            'amount'=>intval($item['amount']),
            'withdraw_mode'=>$item['draw'],
            'callback_url'=>$item['callback_url']
        ];
        logger(json_encode($data,JSON_UNESCAPED_SLASHES));
        $response = $this->cURL($this->base_url . "disburse/get-invoice", $data);
        logger(json_encode($response));
        if ($response->response_code=='00'){
            $txnid =$item['number'];
            $transaction=Transaction::query()->firstWhere(['number_transaction'=>$txnid]);
            $transaction->reference_partner=$response->disburse_token;
            $transaction->save();
            $soud=[
                'disburse_invoice'=>$response->disburse_token,
                'disburse_id'=>$txnid
            ];
            return $this->cURL($this->base_url . "disburse/submit-invoice", $soud);
        }else{
            return $response;
        }
    }
    public function checkStatus($token){
        $soud=[
            'disburse_invoice'=>$token,
        ];
        return $this->cURL($this->base_url . "disburse/check-status", $soud);
    }

    protected function cURL($url, $json)
    {
        $ch = curl_init($url);

        // Request headers
        $headers = array(
            'Content-Type:application/json',
            "PAYDUNYA-MASTER-KEY: ".config("PAYDUNYA_PRINCIPAL"),
            "PAYDUNYA-PRIVATE-KEY: ".config("PAYDUNYA_SECRET_KEY"),
            "PAYDUNYA-TOKEN: ".config("PAYDUNYA_TOKEN")
        );
        // Return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($json,JSON_UNESCAPED_SLASHES));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // $output contains the output string
        $output = curl_exec($ch);

        // Close curl resource to free up system resources
        curl_close($ch);
        return json_decode($output);
    }
}
