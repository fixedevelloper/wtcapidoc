<?php


namespace App\Services;


use App\Models\Transaction;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpKernel\Exception\NotAcceptableHttpException;

class WaceApiService
{
    public function authenticate()
    {
        $endpoint = 'api/v1/login';
        $arrayJson = [
            "email" => config('app.WACEPAY_USERNAME'),
            "password" => config('app.WACEPAY_PASSWORD')
        ];
        logger()->info($arrayJson);
        $response = $this->cURLAuth($endpoint, json_encode($arrayJson));

        logger()->info(json_encode($response));
        if ($response->status === 2000) {
            session(['wace_access_token' => $response->access_token]);
        }
    }
    public function sendTransaction(Transaction $transaction)
    {
        $endpoint = 'api/v1/transaction/bank/create';


            $sender = $this->getCreateSender($transaction);
            $beneficiaryReponse = $this->createBeneficiary($transaction, $sender->sender->Code);
            if ($beneficiaryReponse->status != 2000) {

                return [
                    "status" => $beneficiaryReponse->status,
                    "message" => $beneficiaryReponse->status
                ];
            }
            $bank = [
                'businessType' => 'P2P',
                "payoutCountry" => $transaction->gatewayItem->country->codeIso2,
                "payoutCity" => $transaction->city,
                "receiveCurrency" => $transaction->gatewayItem->country->currency,
                "amountToPaid" => $transaction->amount_total,
                "senderCode" => $sender->sender->Code,
                "beneficiaryCode" => $beneficiaryReponse->beneficiary->Code,
                "sendingCurrency" => $sender->currency,
                "bankAccount" => $transaction->accountnumber,
                "bankName" => $transaction->gatewayItem->name,
                "bankSwCode" => $transaction->swift,
                "bankBranch" => '',
                "fromCountry" => $transaction->sender->country->codeIso2,
                "payerCode" => $transaction->gatewayItem->payer_code,
                "originFund" => $transaction->origin_fond,
                "reason" => $transaction->motif_send,
                "relation" => $transaction->relation,
            ];
            logger("##################wace body request###########################" . json_encode($bank));
            $res = $this->cURL($endpoint, json_encode($bank));
            logger("##################wace body response###########################" . json_encode($res));
            if ($res->status != 2000) {
                return [
                    "status" => $res->status,
                    "message" => $res->message
                ];
            }
            $valid = $this->validateTransaction($res->transaction->reference);
            logger('########### start validate wace###############');
            logger()->error(json_encode($valid));
            if ($valid->status == 2000) {
                return [
                    "status" => 2000,
                    "data" => $res->transaction,
                    'reference' => $res->transaction->reference
                ];
            } else {
                return [
                    "status" => $valid->status,
                    "data" => $valid->messages
                ];
            }
    }

    public function sendTransactionOM(Transaction $transaction)
    {
        $endpoint = 'api/v1/transaction/wallet/create';
        $this->tokencinet = $this->authenticate()['token'];
        if (!is_null($this->tokencinet)) {
            $sender = $this->getCreateSender($transaction);
            $beneficiaryReponse = $this->createBeneficiary($transaction, $sender->sender->Code);
            if ($beneficiaryReponse->status !== 2000) {
                throw new NotAcceptableHttpException($beneficiaryReponse->message);
            }
            $operator=$this->operateurRepository->findOneBy(['name'=>$transaction->getOperateur(),'gateway'=>'WACEPAY']);
            $wallet = [
                "payoutCountry" => $transaction->getCountry()->getCodeString(),
                "payoutCity" => $transaction->getTown()->getLibelle(),
                "receiveCurrency" => $transaction->getCountry()->getMonaire(),
                "amountToPaid" => $transaction->getMontanttotal(),
                "senderCode" => $sender->sender->Code,
                "beneficiaryCode" => $beneficiaryReponse->beneficiary->Code,
                "sendingCurrency" => $transaction->getCustomer()->getCountry()->getMonaire(),
                "service" => $operator->getShortcode(),
                "mobileReceiveNumber" => $transaction->getBeneficiare()->getPhone(),
                "fromCountry" => $transaction->getCustomer()->getCountry()->getCodeString(),
                "payerCode" => $transaction->getCountry()->getPayerCode(),
                "originFund" => is_null($transaction->getOriginFonds())?'Salary':$transaction->getOriginFonds(),
                "reason" => is_null($transaction->getRaisontransaction())?'Salary':$transaction->getRaisontransaction(),
                "relation" => is_null($transaction->getRelaction())?"Brother":$transaction->getRelaction()
            ];
            $this->logger->info("------paybody" . json_encode($wallet));
            $res = $this->cURL($endpoint, json_encode($wallet));
            $this->logger->info("------response" . json_encode($res));
            if ($res->status != 2000) {
                $valid = $this->validateTransaction($res->transaction->reference);
                if ($valid->status == 2000) {
                    return [
                        "status" => 2000,
                        "data" => $res->transaction,
                        'reference' => $res->transaction->reference
                    ];
                } else {
                    return [
                        "status" => $valid->status,
                        "data" => $valid->message
                    ];
                }
            } else {
                return [
                    "status" => 500,
                    "data" => ['status' => 500]
                ];
            }

        } else {
            return [
                "status" => 500,
                "data" => ['status' => 500]
            ];
        }

    }

    public function getStatusTransaction($reference)
    {
        if (!Session::has(['wace_access_token'])) {
            $this->authenticate();
        }
        $endpoint = 'api/v1/transaction/status/' . $reference;
        $curl = curl_init();
        // Request headers
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.WACEPAY_URL') . '/' . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . Session::get('wace_access_token')
            ),
        ));

        // $output contains the output string
        $output = curl_exec($curl);
        curl_close($curl);
        return json_decode($output);
    }

    public function getPayercodeWacePay($codeIso, $currency)
    {

        $endpoint = 'api/v1/transaction/payercode';
        $body = [
            "payoutCountry" => $codeIso,
            "payoutService" => 'B',
            "CurrencyPayout" => $currency
        ];
        return $this->cURL($endpoint, json_encode($body));
    }
    public function getPayercodeWacePayByserice($codeIso, $currency,$service)
    {

        $endpoint = 'api/v1/transaction/payercode';
        $body = [
            "payoutCountry" => $codeIso,
            "payoutService" => $service,
            "CurrencyPayout" => $currency
        ];
        return $this->cURL($endpoint, json_encode($body));
    }
    public function getStatusBalance()
    {
        $endpoint = '/api/v1/account/balance';
        $options = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ]
        ];
        if (!is_null($token)) {
            $res = $this->client->get($endpoint, $options);
            return [
                'status' => 500,
                'data' => json_decode($res->getBody(), true)
            ];
        } else {
            return [
                'status' => 500,
                'data' => []
            ];
        }

    }

    public function getBankWacePay($code, $payercode)
    {
        $endpoint = 'api/v1/transaction/bank/list';
        $body = [
            "iso2" => $code,
            "payercode" => $payercode
        ];
        return $this->cURL($endpoint, json_encode($body));
    }

    public function getTownWacePay($payercode)
    {
        $endpoint = 'api/v1/transaction/city/list';
        $body = [
            "payercode" => $payercode
        ];
        return $this->cURL($endpoint, json_encode($body));
    }

    public function getCreateSender(Transaction $transaction)
    {
        $endpoint = 'api/v1/sender/create';
        $sender = $transaction->sender;
        $sender = [
            'type' => 'P',
            'dob' => $sender->date_birth,
            'expire_date' => $sender->expired_document,
            "firstName" => $sender->first_name,
            "lastName" => $sender->last_name,
            "address" => $sender->address,
            "phone" => $sender->phone,
            "country" => $sender->country,
            "city" => $sender->city,
            "gender" => $sender->gender,
            "civility" => $sender->civility,
            "idNumber" => $sender->num_document,
            'idType'=>$sender->identification_document,
            "occupation" =>$sender->occupation,
            "state" => "",
            "nationality" => $sender->country,
            "comment" => "new sender",
            "zipcode" => "78952",
            "dateOfBirth" => $sender->date_birth,
            "dateExpireId" =>$sender->expired_document,
            "pep" => false,
            "updateIfExist" => true
        ];
       logger()->info("##############DataCustomer################");
        logger()->info(json_encode($sender));
        $res = $this->cURL($endpoint, json_encode($sender));
        logger()->info(json_encode($res));
        return $res;
    }

    public function createBeneficiary(Transaction $transaction, $code)
    {
        $endpoint = 'api/v1/beneficiary/create';
        $beneficiary_ = $transaction->beneficiary;
        $beneficiary = [
            'type' => 'P',
            'dob' => $beneficiary_->date_birth,
            'expire_date' =>$beneficiary_->expired_document,
            'dateOfBirth' => $beneficiary_->date_birth,
            'dateExpireId' => $beneficiary_->expired_document,
            "firstName" => $beneficiary_->first_name,
            "lastName" => $beneficiary_->last_name,
            "address" => $transaction->city,
            "phone" => $beneficiary_->phone,
            "country" => $transaction->gatewayItem->country->codeIso2,
            "city" => $transaction->city,
            "mobile" => $beneficiary_->phone,
            "email" =>$beneficiary_->email,
            "idNumber" => $beneficiary_->num_document,
            "idType" => $beneficiary_->identification_document,
            "sender_code" => $code,
            "updateIfExist" => true
        ];
        logger()->info("##############DataBeneficiary################");
        logger()->info(json_encode($beneficiary));
        $response=$this->cURL($endpoint, json_encode($beneficiary));
        logger(json_encode($response));
        return $response;
    }

    public function validateTransaction($reference)
    {
        $endpoint = 'api/v1/transaction/confirm';
        $body = [
            "reference" => $reference
        ];
        return $this->cURL($endpoint, json_encode($body));
    }

    protected function cURLAuth($url, $json)
    {
        // Create curl resource
        $ch = curl_init(config('app.WACEPAY_URL') . '/' . $url);

        // Request headers
        $headers = array(
            'Accept' => 'application/json',
            'Content-Type:application/json',
        );

        // Return the transfer as a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $output = curl_exec($ch);
        curl_close($ch);
        return json_decode($output);
    }

    protected function cURL($url, $json)
    {
        if (!Session::has(['wace_access_token'])) {
            $this->authenticate();
        }
        $curl = curl_init();
        // Request headers
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.WACEPAY_URL') . '/' . $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $json,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . Session::get('wace_access_token')
            ),
        ));

        // $output contains the output string
        $output = curl_exec($curl);

        // Close curl resource to free up system resources
        curl_close($curl);
        return json_decode($output);
    }
}
