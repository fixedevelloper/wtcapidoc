<?php

namespace App\Console\Commands;

use App\Helpers\api\Helpers;
use App\Helpers\Helper;
use App\Models\Transaction;
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
        $this->validateWace();
    }
    function validateWace(){
        $transactions=Transaction::query()->where('status','=',Helper::STATUSWAITING)
            ->orWhere(['status'=>Helper::STATUSPROCESSING])->where(['type'=>Helper::TYPESECURE,'wallet'=>'AGENSICPAY_ALL'])->latest();
        logger("####################BEGIN VALIDATION WACE################################");
        foreach ($transactions as $transaction){
            $response = $this->waceService->getStatusTransaction($transaction->reference_partner);

            logger(json_encode($response));
            if (isset($response->status) && $response->status == 2000) {
                if ($response->transaction->Status=='PAID'){
                   // $this->telegramService->senMoney($transaction_pending);
                    $transaction->status=Helper::STATUSSUCCESS;
                }elseif ($response->transaction->Status=='CANCELED'){
                    $transaction->status=Helper::STATUSFAILD;
                }else{
                    $transaction->status=Helper::STATUSPROCESSING;
                }
                $transaction->save();

            }
        }
        logger("####################END VALIDATION WACE################################");
    }
}
