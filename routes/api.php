<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user(); // <-- TAMBAHKAN ; DI SINI
});

// Ini adalah URL yang akan Anda berikan ke Midtrans
Route::post('/midtrans-hook', [WebhookController::class, 'handle'])->name('midtrans.webhook');