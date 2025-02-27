<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DocsController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SpellbookController;
use Illuminate\Support\Facades\Route;

Route::controller(FrontController::class)->group(function () {
    Route::get("/", "index")->name("main");
    Route::get("/pages/{slug}", "standardPage")->name("standard-page");

    Route::prefix("courses")->group(function () {
        Route::get("{course}", "viewCourse")->name("course-view");
        Route::get("", "listCourses")->name("courses-list");
    });

    Route::prefix("specialists")->group(function () {
        Route::get("{specialist}", "viewSpecialist")->name("specialist-view");
        Route::get("", "listSpecialists")->name("specialists-list");
    });

    Route::prefix("films")->group(function () {
        Route::get("{film}", "viewFilm")->name("film-view");
        Route::get("", "listFilms")->name("films-list");
    });

    Route::get("search/{model_name}", "search")->name("search");
});

Route::controller(BlogController::class)->prefix("blog")->group(function () {
    Route::get("", "list")->name("blog-list");
    Route::get("{slug}", "view")->name("blog-view");
});

Route::middleware("auth")->group(function () {
    Route::controller(ProfileController::class)->prefix("profile")->group(function () {
        Route::get("/", "myProfile")->name("profile");

        Route::prefix("survey")->group(function () {
            Route::get("list", "listSurveys")->middleware("role:blogger")->name("profile-surveys");
            Route::get("edit", "editSurvey")->name("profile-survey");
            Route::post("edit", "processSurvey")->name("profile-process-survey");
        });
    });

    Route::controller(ReviewController::class)->middleware("role:reviewer")->prefix("reviews")->group(function () {
        Route::get("list/{model}/{id}", "listReviews")->name("reviews-list");
        Route::post("add", "addReview")->name("review-add");
    });

    Route::controller(AdminController::class)->prefix("admin")->group(function () {
        Route::prefix("settings")->middleware("role:technical")->group(function () {
            Route::get("", "settings")->name("admin-settings");
            Route::post("", "processSettings")->name("admin-process-settings");
        });

        Route::prefix("adverts")->middleware("role:technical")->group(function () {
            Route::get("", "advertSettings")->name("admin-advert-settings");
            Route::post("", "processAdvertSettings")->name("admin-process-advert-settings");
        });

        Route::prefix("files")->group(function () {
            Route::get("", "files")->name("files-list");
            Route::get("download", "filesDownload")->name("files-download");
            Route::middleware("role:blogger")->group(function () {
                Route::post("upload", "filesUpload")->name("files-upload");
                Route::get("delete", "filesDelete")->name("files-delete");
            });

            Route::prefix("folder")->group(function () {
                Route::get("new", "folderNew")->name("folder-new");
                Route::post("create", "folderCreate")->name("folder-create");
                Route::get("delete", "folderDelete")->name("folder-delete");
            });
        });

        Route::prefix("{model}")->group(function () {
            Route::get("", "listModel")->name("admin-list-model");
            Route::get("edit/{id?}", "editModel")->name("admin-edit-model");
            Route::post("edit", "processEditModel")->name("admin-process-edit-model");
        });
    });
});

Route::controller(DocsController::class)->prefix("docs")->group(function () {
    Route::get("{slug}", "view")->where("slug", "[a-zA-Z0-9-/]+")->name("docs-view");
    Route::get("", "index")->name("docs-index");
});

Route::controller(SpellbookController::class)->middleware("role:super")->group(function () {
    foreach (SpellbookController::SPELLS as $spell_name => $route) {
        Route::get($route, $spell_name);
    }
});

require __DIR__.'/auth.php';
