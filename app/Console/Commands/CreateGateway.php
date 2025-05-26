<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Country;
use App\Models\Gateway;
use App\Services\WaceApiService;
use Illuminate\Console\Command;

class CreateGateway extends Command
{
    protected $waceService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-gateway';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * CreateGateway constructor.
     * @param $waceService
     */
    public function __construct(WaceApiService $waceService)
    {
        parent::__construct();
        $this->waceService = $waceService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->mobileGateway();
        $this->bankGateway();

    }

    function bankGateway()
    {
        $countries = Country::query()->latest()->get();
        foreach ($countries as $country) {
            $resp = $this->waceService->getPayercodeWacePay($country->codeIso2, $country->currency);
            if ($resp->status==2000){
                $payers = $resp->transaction;
                if (count($payers) > 0) {
                    logger($payers);
                    $code = $payers[0];
                    if ($code->PayerCode !=='NULL'){
                        $banks = $this->waceService->getBankWacePay($country->codeIso2, $code->PayerCode);
                        logger(json_encode($banks));
                        foreach ($banks->data as $datum) {
                            $gateway = Gateway::query()->firstWhere(['name' => $datum->BankName, 'country_id' => $country->id]);
                            if (is_null($gateway)) {
                                $gateway = new Gateway();
                                $gateway->name = $datum->BankName;
                                $gateway->code = $datum->BankCode;
                                $gateway->method = 'WACEPAY';
                                $gateway->type = 'BANK';
                                $gateway->country_id = $country->id;
                                $gateway->save();
                            }
                            $gateway->payer_code=$code->PayerCode;
                            $gateway->save();
                        }
                        $this->createCity($code->PayerCode,$country->id);
                    }

                }
            }

        }
    }

    function mobileGateway()
    {
        $countries = [
            ['code' => 'CM',
                'method' => 'FLUTTERWAVE',
                'carries' => [
                    'MTN', 'ORANGEMONEY'
                ]
            ],
           ['code' => 'CG',
                'method' => 'AGENSICPAY',
                'carries' => [
                    'MTN', 'Airtel'
                ]
            ],
            ['code' => 'CD',
                'method' => 'AGENSICPAY',
                'carries' => [
                    'Orange',
                ]
            ],
            ['code' => 'SN',
                'method' => 'PAYDUNYA',
                'carries' => [
                    'ORANGE MONEY SENEGAL', 'EXPRESSO SN', 'FREE MONEY SENEGAL', 'WAVE SENEGAL'
                ]
            ],
            ['code' => 'SN',
                'method' => 'PAYDUNYA',
                'carries' => [
                    'ORANGE MONEY SENEGAL', 'EXPRESSO SN', 'FREE MONEY SENEGAL', 'WAVE SENEGAL'
                ]
            ],
            ['code' => 'CI',
                'method' => 'PAYDUNYA',
                'carries' => [
                    'ORANGE MONEY CI','MTN CI','MOOV CI','WAVE CI'
                ]
            ],
            ['code' => 'BJ',
                'method' => 'PAYDUNYA',
                'carries' => [
                    'MOOV BENIN', 'MTN BENIN'
                ]
            ],
            ['code' => 'BF',
                'method' => 'PAYDUNYA',
                'carries' => [
                    'ORANGE MONEY BURKINA','MOOV BURKINA FASO'
                ]
            ],
            ['code' => 'TG',
                'method' => 'PAYDUNYA',
                'carries' => [
                    'T MONEY TOGO','MOOV TOGO'
                ]
            ],
            ['code' => 'ML',
                'method' => 'PAYDUNYA',
                'carries' => [
                    'MOOV ML'
                ]
            ],
        ];

        foreach ($countries as $code) {
            $country = Country::query()->firstWhere(['codeIso2' => $code['code']]);
            foreach ($code['carries'] as $carrier) {
                $gateway = Gateway::query()->firstWhere(['country_id' => $country->id, 'name' => $carrier]);
                if (is_null($gateway)) {
                    $gateway = new Gateway();
                    $gateway->name = $carrier;
                    $gateway->method = $code['method'];
                    $gateway->type = 'MOBIL';
                    $gateway->country_id = $country->id;
                    $gateway->save();
                }
            }

        }


    }
    function createCity($codePayer,$country_id){
        $response=$this->waceService->getTownWacePay($codePayer);
        if (isset($response->messages)){
            foreach ($response->messages as $message){
                $city=City::query()->firstWhere(['country_id'=>$country_id,'name'=>$message->CityName]);
                if (is_null($city)){
                    $city=new City();
                    $city->name=$message->CityName;
                    $city->country_id=$country_id;
                    $city->code=substr($message->CityName,0,3);
                    $city->save();
                }
            }
        }
    }
}
