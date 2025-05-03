<?php


use App\Http\Controllers\Sandbox\api\AuthApiController;
use App\Http\Controllers\Sandbox\api\CustomerApiController;
use App\Http\Controllers\Sandbox\api\TransactionApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthApiController::class, 'login']);
Route::middleware('auth:api')->get('user', [AuthApiController::class, 'me']);
Route::middleware('customer.jwt')->group(function () {
    Route::get('customer/profile', function (Request $request) {

        return response()->json([
            'message' => 'Customer authentifié avec succès',
            'customer' => $request->customer
        ]);
    });
    Route::group(['middleware' => ['logs.api']], function () {
        Route::get('/transaction/status', [TransactionApiController::class, 'getTransaction']);
        Route::post('/transactions/bank', [TransactionApiController::class, 'postBankTransaction']);
        Route::get('/banks', [CustomerApiController::class, 'getBanks']);
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


