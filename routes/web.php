<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::controller(FrontController::class)->group(function () {
    Route::get("/", "index")->name("main");
});

Route::controller(ProfileController::class)->prefix("profile")->group(function () {
    Route::get("/", "myProfile")->name("profile");
});

require __DIR__.'/auth.php';
