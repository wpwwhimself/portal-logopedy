<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post("/token", "apiToken")->name("api-token");
});

Route::middleware("auth:sanctum")->group(function () {
    Route::get('/me', function (Request $rq) {
        return $rq->user();
    });
});

