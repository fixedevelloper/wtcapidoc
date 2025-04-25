<?php

use App\Http\Controllers\Admin\BasicController;
use App\Http\Controllers\Admin\SecurityAdminController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\Sandbox\SecurityController;
use App\Http\Controllers\Sandbox\StaticController;
use App\Http\Controllers\SandboxOldController;
use App\Http\Controllers\SecureController;
use Illuminate\Support\Facades\Route;


/*
Route::domain('doc.agensic.com')->group(function () {

    Route::get('/', [DefaultController::class, 'home'])->name('home');
    Route::get('/countries', [DefaultController::class, 'country'])->name('countries');
    Route::get('/gateway', [DefaultController::class, 'geteway'])->name('gateway');
    Route::get('/cities', [DefaultController::class, 'cities'])->name('cities');
    Route::get('/operators', [DefaultController::class, 'operators'])->name('operators');
    Route::get('/transfert/bank', [DefaultController::class, 'transfert_bank'])->name('transfert_bank');
    Route::get('/transfert/mobil', [DefaultController::class, 'transfert_mobil'])->name('transfert_mobil');
    Route::get('/senders', [DefaultController::class, 'create_sender'])->name('create_sender');
    Route::get('/beneficiaries', [DefaultController::class, 'create_beneficiary'])->name('create_beneficiary');
});*/


//Route::domain('sandbox.agensic.com')->group(function () {
    Route::match(["POST", "GET"], '/logout', [SecureController::class, 'logout'])->name('sandbox.logout');
Route::match(["POST", "GET"], '/', [SecurityController::class, 'sandboxLogin'])->name('sandbox.login');
    Route::match(["POST", "GET"], '/register', [SecurityController::class, 'register'])->name('sandbox.register');
    Route::group(['middleware' => ['sandbox.api']], function () {
        Route::match(["POST", "GET"], '/dashboard', [StaticController::class, 'dashboard'])->name('sandbox.dashboard');
        Route::match(["POST", "GET"], '/profil', [StaticController::class, 'profil'])->name('sandbox.profil');
        Route::match(["POST", "GET"], '/make_bank', [StaticController::class, 'make_bank'])->name('sandbox.make_bank');
        Route::match(["POST", "GET"], '/make_mobil', [StaticController::class, 'make_mobil'])->name('sandbox.make_mobil');
        Route::match(["POST", "GET"], '/transfer_list', [StaticController::class, 'transferList'])->name('sandbox.transferList');
        Route::match(["POST", "GET"], '/sandboxsenders', [StaticController::class, 'senders'])->name('sandbox.senders');
        Route::match(["POST", "GET"], '/sandboxsenders/add', [StaticController::class, 'addSender'])->name('sandbox.add.senders');
        Route::match(["POST", "GET"], '/sandboxbeneficiaries/add', [StaticController::class, 'addBeneficiaries'])->name('sandbox.add.beneficiaries');
        Route::match(["POST", "GET"], '/sandboxbeneficiaries', [StaticController::class, 'beneficiaries'])->name('sandbox.beneficiaries');
        Route::match(["POST", "GET"], '/get_ajax_beneficiaries', [StaticController::class, 'getBeneficiaryAjax'])->name('sandbox.get_ajax_beneficiaries');
        Route::match(["POST", "GET"], '/get_ajax_cities', [StaticController::class, 'getCitiesAjax'])->name('sandbox.get_ajax_cities');
        Route::match(["POST", "GET"], '/get_ajax_operators', [StaticController::class, 'getOperatorsAjax'])->name('sandbox.get_ajax_operators');
        Route::match(["POST", "GET"], '/get_ajax_rate', [StaticController::class, 'getRateAjax'])->name('sandbox.get_ajax_rate');
    });
//});
/*Route::domain('secure.agensic.com')->group(function () {
    Route::match(["POST", "GET"], '/', [SecurityAdminController::class, 'secureLogin'])->name('secure.login');
    Route::match(["POST", "GET"], '/register', [SecurityAdminController::class, 'secureRegister'])->name('secure.register');
    Route::group(['middleware' => ['remote.api']], function () {
        Route::match(["POST", "GET"], '/dashboard', [SecurityAdminController::class, 'dashboard'])->name('secure.dashboard');
        Route::match(["POST", "GET"], '/make_bank', [SecurityAdminController::class, 'make_bank'])->name('secure.make_bank');
        Route::match(["POST", "GET"], '/make_mobil', [SecurityAdminController::class, 'make_mobil'])->name('secure.make_mobil');
        Route::match(["POST", "GET"], '/transfer_list', [SecurityAdminController::class, 'transferList'])->name('secure.transferList');
        Route::match(["POST", "GET"], '/securesenders', [SecurityAdminController::class, 'senders'])->name('secure.senders');
        Route::match(["POST", "GET"], '/securesenders/add', [SecurityAdminController::class, 'addSender'])->name('secure.add.senders');
        Route::match(["POST", "GET"], '/securebeneficiaries/add', [SecurityAdminController::class, 'addBeneficiaries'])->name('secure.add.beneficiaries');
        Route::match(["POST", "GET"], '/securebeneficiaries', [SecurityAdminController::class, 'beneficiaries'])->name('secure.beneficiaries');
        Route::match(["POST", "GET"], '/get_ajax_beneficiaries', [SecurityAdminController::class, 'getBeneficiaryAjax'])->name('secure.get_ajax_beneficiaries');
        Route::match(["POST", "GET"], '/get_ajax_cities', [SecurityAdminController::class, 'getCitiesAjax'])->name('secure.get_ajax_cities');
        Route::match(["POST", "GET"], '/get_ajax_operators', [SecurityAdminController::class, 'getOperatorsAjax'])->name('secure.get_ajax_operators');
    });
});

Route::domain('manage.agensic.com')->group(function () {
    Route::match(["POST", "GET"], '/', [SecurityAdminController::class, 'adminLogin'])->name('admin.login');
    Route::match(["POST", "GET"], '/register', [SecurityAdminController::class, 'register'])->name('admin.register');
   // Route::group(['middleware' => ['remote.api']], function () {
        Route::match(["POST", "GET"], '/dashboard', [BasicController::class, 'dashboard'])->name('admin.dashboard');
Route::match(["POST", "GET"], '/customers', [BasicController::class, 'customers'])->name('admin.customers');
Route::match(["POST", "GET"], '/customers/add', [SecurityAdminController::class, 'create_customer_direct'])->name('admin.add.customer');
Route::match(["POST", "GET"], '/senders', [BasicController::class, 'senders'])->name('admin.senders');
Route::match(["POST", "GET"], '/beneficiaries', [BasicController::class, 'beneficiaries'])->name('admin.beneficiaries');
Route::match(["POST", "GET"], '/transactions', [TransactionController::class, 'transactions'])->name('admin.transactions');
Route::match(["POST", "GET"], '/rates', [BasicController::class, 'rates'])->name('admin.rates');
    Route::match(["POST", "GET"], '/customers/rate/{id}', [BasicController::class, 'addrates',])->name('admin.addrates');
Route::match(["POST", "GET"], '/countries', [BasicController::class, 'countries'])->name('admin.countries');
Route::match(["POST", "GET"], '/saveCountry', [BasicController::class, 'saveCountry'])->name('admin.saveCountry');
Route::match(["POST", "GET"], '/cities', [BasicController::class, 'cities'])->name('admin.cities');
Route::match(["POST", "GET"], '/gateways', [BasicController::class, 'gateways'])->name('admin.gateways');
    //});
});*/
