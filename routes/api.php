<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AutomationController;
use App\Http\Controllers\EntityManagementController;
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
        Route::middleware("role:course-master")->post("course", "processCourse")->name("automation-course");
    });

    Route::controller(AdminController::class)->prefix("admin")->group(function () {
        Route::get("{scope}/{id?}", "apiGetModel");
        Route::post("{scope}", "apiProcessModel");
        Route::patch("{scope}/{id}", "apiPatchModel");
        Route::delete("{scope}/{id}", "apiDeleteModel");
    });
});

Route::controller(EntityManagementController::class)->prefix("entmgr")->group(function () {
    Route::get("list-categories/{model_name}", "listCategories")->name("entmgr-list-categories");
});
