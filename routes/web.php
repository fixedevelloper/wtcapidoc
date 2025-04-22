<?php

use App\Http\Controllers\DefaultController;
use App\Http\Controllers\SandboxController;
use App\Http\Controllers\SecureController;
use Illuminate\Support\Facades\Route;



Route::domain('documentation.agensic.com')->group(function () {

    Route::get('/', [DefaultController::class, 'home'])->name('home');
    Route::get('/countries', [DefaultController::class, 'country'])->name('countries');
    Route::get('/gateway', [DefaultController::class, 'geteway'])->name('gateway');
    Route::get('/cities', [DefaultController::class, 'cities'])->name('cities');
    Route::get('/operators', [DefaultController::class, 'operators'])->name('operators');
    Route::get('/transfert/bank', [DefaultController::class, 'transfert_bank'])->name('transfert_bank');
    Route::get('/transfert/mobil', [DefaultController::class, 'transfert_mobil'])->name('transfert_mobil');
    Route::get('/senders', [DefaultController::class, 'create_sender'])->name('create_sender');
    Route::get('/beneficiaries', [DefaultController::class, 'create_beneficiary'])->name('create_beneficiary');
});


Route::domain('sandbox.agensic.com')->group(function () {
    Route::match(["POST", "GET"], '/logout', [SecureController::class, 'logout'])->name('sandbox.logout');
Route::match(["POST", "GET"], '/', [SandboxController::class, 'sandboxLogin'])->name('sandbox.login');
    Route::match(["POST", "GET"], '/register', [SandboxController::class, 'sandboxRegister'])->name('sandbox.register');
    Route::group(['middleware' => ['sandbox.api']], function () {
        Route::match(["POST", "GET"], '/dashboard', [SandboxController::class, 'dashboard'])->name('sandbox.dashboard');
        Route::match(["POST", "GET"], '/make_bank', [SandboxController::class, 'make_bank'])->name('sandbox.make_bank');
        Route::match(["POST", "GET"], '/make_mobil', [SandboxController::class, 'make_mobil'])->name('sandbox.make_mobil');
        Route::match(["POST", "GET"], '/transfer_list', [SandboxController::class, 'transferList'])->name('sandbox.transferList');
        Route::match(["POST", "GET"], '/sandboxsenders', [SandboxController::class, 'senders'])->name('sandbox.senders');
        Route::match(["POST", "GET"], '/sandboxsenders/add', [SandboxController::class, 'addSender'])->name('sandbox.add.senders');
        Route::match(["POST", "GET"], '/sandboxbeneficiaries/add', [SandboxController::class, 'addBeneficiaries'])->name('sandbox.add.beneficiaries');
        Route::match(["POST", "GET"], '/sandboxbeneficiaries', [SandboxController::class, 'beneficiaries'])->name('sandbox.beneficiaries');
        Route::match(["POST", "GET"], '/get_ajax_beneficiaries', [SandboxController::class, 'getBeneficiaryAjax'])->name('sandbox.get_ajax_beneficiaries');
        Route::match(["POST", "GET"], '/get_ajax_cities', [SandboxController::class, 'getCitiesAjax'])->name('sandbox.get_ajax_cities');
        Route::match(["POST", "GET"], '/get_ajax_operators', [SandboxController::class, 'getOperatorsAjax'])->name('sandbox.get_ajax_operators');
    });
});
Route::domain('secure.agensic.com')->group(function () {
    Route::match(["POST", "GET"], '/', [SecureController::class, 'secureLogin'])->name('secure.login');
    Route::match(["POST", "GET"], '/register', [SecureController::class, 'secureRegister'])->name('secure.register');
    Route::group(['middleware' => ['remote.api']], function () {
        Route::match(["POST", "GET"], '/dashboard', [SecureController::class, 'dashboard'])->name('secure.dashboard');
        Route::match(["POST", "GET"], '/make_bank', [SecureController::class, 'make_bank'])->name('secure.make_bank');
        Route::match(["POST", "GET"], '/make_mobil', [SecureController::class, 'make_mobil'])->name('secure.make_mobil');
        Route::match(["POST", "GET"], '/transfer_list', [SecureController::class, 'transferList'])->name('secure.transferList');
        Route::match(["POST", "GET"], '/securesenders', [SecureController::class, 'senders'])->name('secure.senders');
        Route::match(["POST", "GET"], '/securesenders/add', [SecureController::class, 'addSender'])->name('secure.add.senders');
        Route::match(["POST", "GET"], '/securebeneficiaries/add', [SecureController::class, 'addBeneficiaries'])->name('secure.add.beneficiaries');
        Route::match(["POST", "GET"], '/securebeneficiaries', [SecureController::class, 'beneficiaries'])->name('secure.beneficiaries');
        Route::match(["POST", "GET"], '/get_ajax_beneficiaries', [SecureController::class, 'getBeneficiaryAjax'])->name('secure.get_ajax_beneficiaries');
        Route::match(["POST", "GET"], '/get_ajax_cities', [SecureController::class, 'getCitiesAjax'])->name('secure.get_ajax_cities');
        Route::match(["POST", "GET"], '/get_ajax_operators', [SecureController::class, 'getOperatorsAjax'])->name('secure.get_ajax_operators');
    });
});
