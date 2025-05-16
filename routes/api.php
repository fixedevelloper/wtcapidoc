<?php


use App\Http\Controllers\Admin\WhatsAppController;
use App\Http\Controllers\Sandbox\api\AuthApiController;
use App\Http\Controllers\Sandbox\api\CustomerApiController;
use App\Http\Controllers\Sandbox\api\TransactionApiController;
use App\Http\Controllers\Secure\api\CustomerApisecureController;
use App\Http\Controllers\Secure\api\TransactionApisecureController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthApiController::class, 'login']);
Route::middleware('auth:api')->get('user', [AuthApiController::class, 'me']);
Route::match(["POST", "GET"], '/notifyurl/paydunya', [TransactionApiController::class, 'notifyPaydunnya']);
Route::domain('secure.agensic.com')->group(function () {
    Route::middleware('customer.jwt')->group(function () {
        Route::group(['middleware' => ['logs.api', 'restrict.ip.secure']], function () {
            Route::get('/transaction/status/{transaction_id}', [TransactionApisecureController::class, 'getTransaction']);
            Route::post('/transactions/bank', [TransactionApisecureController::class, 'postBankTransaction']);
            Route::post('/transactions/mobil', [TransactionApisecureController::class, 'postMobilTransaction']);
            Route::get('/banks', [CustomerApisecureController::class, 'getBanks']);
            Route::get('/networks', [CustomerApisecureController::class, 'getNetworks']);
            Route::get('/countries', [CustomerApisecureController::class, 'getCountries']);
            Route::get('/cities', [CustomerApisecureController::class, 'getCities']);
            Route::get('/senders', [CustomerApisecureController::class, 'getSenders']);
            Route::get('/senders/detail', [CustomerApisecureController::class, 'getSender']);
            Route::get('/beneficiaries', [CustomerApisecureController::class, 'getBeneficiaries']);
            Route::get('/beneficiaries/detail', [CustomerApisecureController::class, 'getBeneficiary']);
            Route::post('/senders', [CustomerApisecureController::class, 'postSenders']);
            Route::post('/beneficiaries', [CustomerApisecureController::class, 'postBeneficiaries']);
        });
    });
});
Route::domain('sandbox.agensic.com')->group(function () {
    Route::middleware('customer.jwt')->group(function () {
        Route::group(['middleware' => ['logs.api', 'restrict.ip.sandbox']], function () {
            Route::get('/transaction/status/{transaction_id}', [TransactionApiController::class, 'getTransaction']);
            Route::post('/transactions/bank', [TransactionApiController::class, 'postBankTransaction']);
            Route::post('/transactions/mobil', [TransactionApiController::class, 'postMobilTransaction']);
            Route::get('/banks', [CustomerApiController::class, 'getBanks']);
            Route::get('/networks', [CustomerApiController::class, 'getNetworks']);
            Route::get('/countries', [CustomerApiController::class, 'getCountries']);
            Route::get('/cities', [CustomerApiController::class, 'getCities']);
            Route::get('/senders', [CustomerApiController::class, 'getSenders']);
            Route::get('/senders/detail', [CustomerApiController::class, 'getSender']);
            Route::get('/beneficiaries', [CustomerApiController::class, 'getBeneficiaries']);
            Route::get('/beneficiaries/detail', [CustomerApiController::class, 'getBeneficiary']);
            Route::post('/senders', [CustomerApiController::class, 'postSenders']);
            Route::post('/beneficiaries', [CustomerApiController::class, 'postBeneficiaries']);
        });
    });
});
Route::domain('chatbot.agensic.com')->group(function () {
    Route::match(["POST", "GET"], '/webhook', [WhatsAppController::class, 'webhook']);
});

