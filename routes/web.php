<?php

use App\Http\Controllers\Admin\BasicController;
use App\Http\Controllers\Admin\SecurityAdminController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\Sandbox\SecurityController;
use App\Http\Controllers\Sandbox\StaticController;
use App\Http\Controllers\Secure\SecuritySecureController;
use App\Http\Controllers\Secure\StaticSecureController;

use Illuminate\Support\Facades\Route;



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
});


Route::domain('sandbox.agensic.com')->group(function () {
    Route::match(["POST", "GET"], '/logout', [SecurityController::class, 'logout'])->name('sandbox.logout');
Route::match(["POST", "GET"], '/', [SecurityController::class, 'sandboxLogin'])->name('sandbox.login');
    Route::match(["POST", "GET"], '/register', [SecurityController::class, 'register'])->name('sandbox.register');
    Route::group(['middleware' => ['sandbox.api']], function () {
        Route::match(["POST", "GET"], '/dashboard', [StaticController::class, 'dashboard'])->name('sandbox.dashboard');
        Route::match(["POST", "GET"], '/profil', [StaticController::class, 'profil'])->name('sandbox.profil');
        Route::match(["POST", "GET"], '/make_bank', [StaticController::class, 'make_bank'])->name('sandbox.make_bank');
        Route::match(["POST", "GET"], '/make_mobil', [StaticController::class, 'make_mobil'])->name('sandbox.make_mobil');
        Route::match(["POST", "GET"], '/transfer_list', [StaticController::class, 'transferList'])->name('sandbox.transferList');
        Route::match(["POST", "GET"], '/transfer_list/detail/{numero_identifiant}', [StaticController::class, 'transaction_detail'])->name('sandbox.transaction_detail');
        Route::match(["POST", "GET"], '/sandboxsenders', [StaticController::class, 'senders'])->name('sandbox.senders');
        Route::match(["POST", "GET"], '/sandboxsenders/add', [StaticController::class, 'addSender'])->name('sandbox.add.senders');
        Route::match(["POST", "GET"], '/sandboxbeneficiaries/add', [StaticController::class, 'addBeneficiaries'])->name('sandbox.add.beneficiaries');
        Route::match(["POST", "GET"], '/sandboxbeneficiaries', [StaticController::class, 'beneficiaries'])->name('sandbox.beneficiaries');
        Route::match(["POST", "GET"], '/get_ajax_beneficiaries', [StaticController::class, 'getBeneficiaryAjax'])->name('sandbox.get_ajax_beneficiaries');
        Route::match(["POST", "GET"], '/get_ajax_cities', [StaticController::class, 'getCitiesAjax'])->name('sandbox.get_ajax_cities');
        Route::match(["POST", "GET"], '/get_ajax_operators', [StaticController::class, 'getOperatorsAjax'])->name('sandbox.get_ajax_operators');
        Route::match(["POST", "GET"], '/get_ajax_rate', [StaticController::class, 'getRateAjax'])->name('sandbox.get_ajax_rate');
    });
});
Route::domain('secure.agensic.com')->group(function () {
    Route::match(["POST", "GET"], '/', [SecuritySecureController::class, 'secureLogin'])->name('secure.login');
    Route::match(["POST", "GET"], '/register', [SecuritySecureController::class, 'secureRegister'])->name('secure.register');
Route::match(["POST", "GET"], '/logout', [SecuritySecureController::class, 'logout'])->name('secure.logout');
    Route::group(['middleware' => ['remote.api']], function () {
        Route::match(["POST", "GET"], '/profil', [StaticSecureController::class, 'profil'])->name('secure.profil');
        Route::match(["POST", "GET"], '/dashboard', [StaticSecureController::class, 'dashboard'])->name('secure.dashboard');
        Route::match(["POST", "GET"], '/make_bank', [StaticSecureController::class, 'make_bank'])->name('secure.make_bank');
        Route::match(["POST", "GET"], '/make_mobil', [StaticSecureController::class, 'make_mobil'])->name('secure.make_mobil');
        Route::match(["POST", "GET"], '/transfer_list', [StaticSecureController::class, 'transferList'])->name('secure.transferList');
        Route::match(["POST", "GET"], '/deposits', [StaticSecureController::class, 'deposits'])->name('secure.deposits');
        Route::match(["POST", "GET"], '/withdraws', [StaticSecureController::class, 'withdraws'])->name('secure.withdraws');
        Route::match(["POST", "GET"], '/journals', [StaticSecureController::class, 'journals'])->name('secure.journals');
        Route::match(["POST", "GET"], '/securesenders', [StaticSecureController::class, 'senders'])->name('secure.senders');
        Route::match(["POST", "GET"], '/transfer_list/detail/{numero_identifiant}', [StaticSecureController::class, 'transaction_detail'])->name('secure.transaction_detail');
        Route::match(["POST", "GET"], '/securesenders/add', [StaticSecureController::class, 'addSender'])->name('secure.add.senders');
        Route::match(["POST", "GET"], '/securebeneficiaries/add', [StaticSecureController::class, 'addBeneficiaries'])->name('secure.add.beneficiaries');
        Route::match(["POST", "GET"], '/securebeneficiaries', [StaticSecureController::class, 'beneficiaries'])->name('secure.beneficiaries');
        Route::match(["POST", "GET"], '/get_ajax_beneficiaries', [StaticSecureController::class, 'getBeneficiaryAjax'])->name('secure.get_ajax_beneficiaries');
        Route::match(["POST", "GET"], '/get_ajax_cities', [StaticSecureController::class, 'getCitiesAjax'])->name('secure.get_ajax_cities');
        Route::match(["POST", "GET"], '/get_ajax_operators', [StaticSecureController::class, 'getOperatorsAjax'])->name('secure.get_ajax_operators');
        Route::match(["POST", "GET"], '/get_ajax_rate', [StaticSecureController::class, 'getRateAjax'])->name('secure.get_ajax_rate');
    });
});

//Route::domain('manage.agensic.com')->group(function () {
    Route::match(["POST", "GET"], '/', [SecurityAdminController::class, 'adminLogin'])->name('admin.login');
    Route::match(["POST", "GET"], '/register', [SecurityAdminController::class, 'register'])->name('admin.register');
    Route::group(['middleware' => ['isAdmin']], function () {
        Route::match(["POST", "GET"], '/dashboard', [BasicController::class, 'dashboard'])->name('admin.dashboard');
Route::match(["POST", "GET"], '/customers', [BasicController::class, 'customers'])->name('admin.customers');
Route::match(["POST", "GET"], '/customers/add', [SecurityAdminController::class, 'create_customer_direct'])->name('admin.add.customer');
Route::match(["POST", "GET"], '/senders', [BasicController::class, 'senders'])->name('admin.senders');
Route::match(["POST", "GET"], '/beneficiaries', [BasicController::class, 'beneficiaries'])->name('admin.beneficiaries');
Route::match(["POST", "GET"], '/transactions', [TransactionController::class, 'transactions'])->name('admin.transactions');
Route::match(["POST", "GET"], '/transaction_sandbox', [TransactionController::class, 'transaction_sandbox'])->name('admin.transaction_sandbox');
    Route::match(["POST", "GET"], '/transactions/detail/{numero_identifiant}', [TransactionController::class, 'transaction_detail'])->name('admin.transaction_detail');

    Route::match(["POST", "GET"], '/rates', [BasicController::class, 'rates'])->name('admin.rates');
        Route::match(["POST", "GET"], '/deposits', [TransactionController::class, 'deposits'])->name('admin.deposits');
        Route::match(["POST", "GET"], '/withdraws', [TransactionController::class, 'withdraws'])->name('admin.withdraws');
        Route::match(["POST", "GET"], '/journals', [TransactionController::class, 'journals'])->name('admin.journals');
    Route::match(["POST", "GET"], '/customers/rate/{id}', [BasicController::class, 'addrates',])->name('admin.addrates');
Route::match(["POST", "GET"], '/countries', [BasicController::class, 'countries'])->name('admin.countries');
Route::match(["POST", "GET"], '/saveCountry', [BasicController::class, 'saveCountry'])->name('admin.saveCountry');
Route::match(["POST", "GET"], '/cities', [BasicController::class, 'cities'])->name('admin.cities');
Route::match(["POST", "GET"], '/gateways', [BasicController::class, 'gateways'])->name('admin.gateways');
        Route::match(["POST", "GET"], '/customers/detail/{code}', [BasicController::class, 'customer_detail'])->name('admin.customer_detail');
Route::match(["POST", "GET"], '/senders/detail/{code}', [BasicController::class, 'sender_detail'])->name('admin.sender_detail');
Route::match(["POST", "GET"], '/beneficiaries/detail/{code}', [BasicController::class, 'beneficiary_detail'])->name('admin.beneficiary_detail');
    });
//});
