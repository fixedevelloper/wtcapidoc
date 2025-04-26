<?php


use App\Http\Controllers\Sandbox\api\AuthApiController;
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
});


