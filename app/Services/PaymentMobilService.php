<?php


namespace App\Services;


use App\Helpers\Helper;
use App\Models\Transaction;

class PaymentMobilService
{
    protected $paydunyaService;
    protected $agensicService;

    /**
     * PaymentMobilService constructor.
     * @param $paydunyaService
     * @param $agensicService
     */
    public function __construct(PayDunyaService $paydunyaService, AgensicService $agensicService)
    {
        $this->paydunyaService = $paydunyaService;
        $this->agensicService = $agensicService;
    }
    function makePayment(Transaction $transaction){
        $country_code=$transaction->gatewayItem->country->codeIso2;
        switch ($transaction->wallet){
            case 'AGENSICPAY_XAF':
                logger($country_code);
                if (in_array($country_code,['CG','CD'])){
                    $country=$country_code=='CG'?'Congo':'DRC';
                    $resp=$this->agensicService->withdraw([
                        'country'=>$country,
                        'carrier'=>$transaction->gatewayItem->name,
                        'phone'=>$transaction->accountNumber,
                        'amount'=>$transaction->amount_total
                    ]);
                    if ($resp['status']==true){
                        $transaction->reference_partner=$resp['transactionId'];
                        $transaction->status=Helper::STATUSPROCESSING;
                        $transaction->save();
                        return[
                          'status'=>true,
                          'message'=>'data send successfully'
                        ];
                    }else{
                        return[
                            'status'=>false,
                            'message'=>'internal error'
                        ];
                    }

                }else{
                    return[
                        'status'=>false,
                        'message'=>'country is coming soon'
                    ];
                }
            case 'AGENSICPAY_XOF':
                $item=[
                    'number'=>$transaction->number_transaction,
                    'phone'=>$transaction->accountNumber,
                    'amount'=>$transaction->amount_total,
                    'draw'=>strtolower(str_ireplace(' ','-',$transaction->gatewayItem->name)),
                    'callback_url'=>'https://secure.agensic.com/api/notifyurl/paydunya'
                ];
                $response=  $this->paydunyaService->make_transfert($item);
                if ($response->response_code=='00'){
                    $transaction->reference_partner=$response['transactionId'];
                    $transaction->status=Helper::STATUSPROCESSING;
                    $transaction->save();
                    return[
                        'status'=>true,
                        'message'=>'data send successfully'
                    ];
                }else{
                    return[
                        'status'=>false,
                        'message'=>'internal error'
                    ];
                }

            default:
            return[
                'status'=>false,
                'message'=>'country is coming soon'
            ];

        }

    }

}
