<?php

namespace App\Console\Commands;

use App\Helpers\api\Helpers;
use App\Helpers\Helper;
use App\Jobs\SendTransactionWebhook;
use App\Models\Customer;
use App\Models\Transaction;
use App\Services\AgensicService;
use App\Services\PayDunyaService;
use App\Services\WaceApiService;
use Illuminate\Console\Command;

class ValidateTransfert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:validate-transfert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $waceService;
    protected $agensicService;
    protected $paydunyaService;
    /**
     * CreateGateway constructor.
     * @param $waceService
     */
    public function __construct(WaceApiService $waceService,AgensicService $agensicService,PayDunyaService $payDunyaService)
    {
        parent::__construct();
        $this->waceService = $waceService;
        $this->agensicService=$agensicService;
        $this->paydunyaService=$payDunyaService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->validateTransaction();
    }
    function validateTransaction(){
        $transactions=Transaction::query()->where('status','=',Helper::STATUSPENDING)
            ->orWhere(['status'=>Helper::STATUSPROCESSING])->where(['type'=>Helper::TYPESECURE,'wallet'=>'WACEPAY'])->get();
        logger("####################BEGIN VALIDATION WACE################################");
        foreach ($transactions as $transaction){
            if ($transaction->gatewayItem->method==='WACEPAY'){
            $response = $this->waceService->getStatusTransaction($transaction->reference_partner);
            logger(json_encode($response));
            if (isset($response->status) && $response->status == 2000) {
                if ($response->transaction->Status=='PAID'){
                    $transaction->status=Helper::STATUSSUCCESS;
                }
                elseif ($response->transaction->Status=='CANCELED'){
                    $transaction->status=Helper::STATUSFAILD;
                    $customer=Customer::query()->find($transaction->customer_id);
                    Helper::create_journal_transfer_cancel($transaction->amount+$transaction->rate,$customer->id,$customer->balance);
                    $customer->balance+=$transaction->amount+$transaction->rate;
                    $customer->save();
                }elseif ($response->transaction->Status=='LOCKED'){
                    $transaction->status=Helper::STATUSHOLD;
                    $customer=Customer::query()->find($transaction->customer_id);
                    Helper::create_journal_transfer_cancel($transaction->amount+$transaction->rate,$customer->id,$customer->balance);
                    $customer->balance+=$transaction->amount+$transaction->rate;
                    $customer->save();
                }else{
                    $transaction->status=Helper::STATUSPROCESSING;
                }
                $transaction->save();
            }
            }
            elseif ($transaction->gatewayItem->method==='AGENSICPAY'){
                logger("####################BEGIN VALIDATION AGENSICPAY################################");
                $json = [
                    'apikey' => '87S86K61M9W11G27R25G99W30O96X23F87D79N85G',
                    'transactionId' => $transaction->reference_partner,
                ];
                $response = $this->agensicService->getPayID($json);
                if (isset($response['status']) && $response['status'] == "Success") {
                    $transaction->status=Helper::STATUSSUCCESS;
                }elseif (isset($response['status']) && $response['status'] == "Failed"){
                    $transaction->status=Helper::STATUSFAILD;
                    $customer=Customer::query()->find($transaction->customer_id);
                    Helper::create_journal_transfer_cancel($transaction->amount+$transaction->rate,$customer->id,$customer->balance);
                    $customer->balance+=$transaction->amount+$transaction->rate;
                    $customer->save();
                }
                $transaction->save();
            }elseif ($transaction->gatewayItem->method==='PAYDUNYA'){
                logger("####################BEGIN VALIDATION PAYDUNYA################################");
                $response = $this->paydunyaService->checkStatus($transaction->reference_partner);
                if ($response->status == 'success') {
                    $transaction->status=Helper::STATUSSUCCESS;
                }elseif (isset($response['status']) && $response['status'] == "failed"){
                    $transaction->status=Helper::STATUSFAILD;
                    $customer=Customer::query()->find($transaction->customer_id);
                    Helper::create_journal_transfer_cancel($transaction->amount+$transaction->rate,$customer->id,$customer->balance);
                    $customer->balance+=$transaction->amount+$transaction->rate;
                    $customer->save();
                }
                $transaction->save();

            }
            if ($transaction->is_notifiable){
                SendTransactionWebhook::dispatch($transaction);
            }
        }

    }
/*    function validateAgensicPay(){
        $transactions=Transaction::query()->where('status','=',Helper::STATUSPENDING)
            ->orWhere(['status'=>Helper::STATUSPROCESSING])->where(['type'=>Helper::TYPESECURE,'wallet'=>'AGENSICPAY_XAF'])->get();
        logger("####################BEGIN VALIDATION AGENSICPAY################################");
        foreach ($transactions as $transaction){
            $json = [
                'apikey' => '87S86K61M9W11G27R25G99W30O96X23F87D79N85G',
                'transactionId' => $transaction->reference_partner,
            ];
            $response = $this->agensicService->getPayID($json);
            if (isset($response['status']) && $response['status'] == "Success") {
                $transaction->status=Helper::STATUSSUCCESS;
            }elseif (isset($response['status']) && $response['status'] == "Failed"){
                $transaction->status=Helper::STATUSFAILD;
                $customer=Customer::query()->find($transaction->customer_id);
                Helper::create_journal_transfer_cancel($transaction->amount+$transaction->rate,$customer->id,$customer->balance);
                $customer->balance+=$transaction->amount+$transaction->rate;
                $customer->save();
            }
            $transaction->save();
            if ($transaction->is_notifiable){
                SendTransactionWebhook::dispatch($transaction);
            }
        }
    }
    function validatePaydunnya(){
        $transactions=Transaction::query()->where('status','=',Helper::STATUSPENDING)
            ->orWhere(['status'=>Helper::STATUSPROCESSING])->where(['type'=>Helper::TYPESECURE,'wallet'=>'AGENSICPAY_XOF'])->get();
        logger("####################BEGIN VALIDATION PAYDUNYA################################");
        foreach ($transactions as $transaction){
            $response = $this->paydunyaService->checkStatus($transaction->reference_partner);

            if ($response->status == 'success') {
                $transaction->status=Helper::STATUSSUCCESS;
            }elseif (isset($response['status']) && $response['status'] == "failed"){
                $transaction->status=Helper::STATUSFAILD;
                $customer=Customer::query()->find($transaction->customer_id);
                Helper::create_journal_transfer_cancel($transaction->amount+$transaction->rate,$customer->id,$customer->balance);
                $customer->balance+=$transaction->amount+$transaction->rate;
                $customer->save();
            }
            $transaction->save();
            if ($transaction->is_notifiable){
                SendTransactionWebhook::dispatch($transaction);
            }

        }
    }*/
}
