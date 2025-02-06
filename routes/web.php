<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::controller(FrontController::class)->group(function () {
    Route::get("/", "index")->name("main");
    Route::get("/pages/{slug}", "standardPage")->name("standard-page");
});

Route::middleware("auth")->group(function () {
    Route::controller(ProfileController::class)->prefix("profile")->group(function () {
        Route::get("/", "myProfile")->name("profile");
    });

    Route::controller(AdminController::class)->prefix("admin")->group(function () {
        Route::prefix("{model}")->group(function () {
            Route::get("", "listModel")->name("admin-list-model");
            Route::get("edit/{id?}", "editModel")->name("admin-edit-model");
            Route::post("edit", "processEditModel")->name("admin-process-edit-model");
        });
    });
});

require __DIR__.'/auth.php';
