<?php

use App\Http\Controllers\DefaultController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DefaultController::class, 'home'])->name('home');
Route::get('/countries', [DefaultController::class, 'country'])->name('countries');
Route::get('/gateway', [DefaultController::class, 'geteway'])->name('gateway');
Route::get('/cities', [DefaultController::class, 'cities'])->name('cities');
Route::get('/operators', [DefaultController::class, 'operators'])->name('operators');
Route::get('/transfert/bank', [DefaultController::class, 'transfert_bank'])->name('transfert_bank');
Route::get('/transfert/mobil', [DefaultController::class, 'transfert_mobil'])->name('transfert_mobil');
Route::get('/senders', [DefaultController::class, 'create_sender'])->name('create_sender');
Route::get('/beneficiaries', [DefaultController::class, 'create_beneficiary'])->name('create_beneficiary');
