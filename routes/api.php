<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutomationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::post("/token", "apiToken");
});

Route::middleware("auth:sanctum")->group(function () {
    Route::get('/me', function (Request $rq) {
        return $rq->user();
    });

    Route::controller(AutomationController::class)->group(function () {
        Route::middleware("role:course-master")->post("course", "processCourse");
    });
});
