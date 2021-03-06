<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\OperateController;
use App\Http\Controllers\CallbackController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'login']);

Route::post('/logout', [LogoutController::class,'logout'])->name('logout');

Route::get('/register', [RegisterController::class,'index'])->name('register');
Route::post('/register', [RegisterController::class,'store']);

Route::post('/operate', [OperateController::class,'index'])->name('operate');
Route::post('/operate/deposit',[TransactionController::class,'deposit'])->name('deposit');
Route::post('/operate/withdraw',[TransactionController::class,'withdraw'])->name('withdraw');

Route::prefix('/transactions')->group(function() {
    Route::get('/', [TransactionController::class,'list'])->name('transactions');
    Route::prefix('/{transaction_id}')->group(function()
    {
        Route::post('/callback',[CallbackController::class,'simulateReceiveCallbackAndReturnSuccessAnswer'])->name('callback');
    });
});
