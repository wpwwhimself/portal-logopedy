<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->prefix("auth")->group(function () {
    Route::get("/login", "login")->name("login");
    Route::post("/login", "processLogin")->name("process-login");

    Route::get("/register", "register")->name("register");
    Route::post("/register", "processRegister")->name("process-register");

    Route::middleware("auth")->group(function () {
        Route::get("/change-password", "changePassword")->name("change-password");
        Route::post("/change-password", "processChangePassword")->name("process-change-password");

        Route::get("/logout", "logout")->name("logout");
    });

    Route::get("/forgot-password", "forgotPassword")->name("forgot-password");
    Route::post("/forgot-password", "processForgotPassword")->name("process-forgot-password");
    Route::get("/reset-password/{token}", "resetPassword")->name("password.reset");
    Route::post("/reset-password", "processResetPassword")->name("process-reset-password");
});
