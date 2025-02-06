<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->string("name")->primary();
            $table->text("description");
        });

        DB::table("roles")->insert([
            // admin-related
            ["name" => "super", "description" => "Może wszystko"],
            ["name" => "technical", "description" => "Ma dostęp do parametrów systemu"],
            ["name" => "course-master", "description" => "Może edytować kartoteki wszystkich kursów"],
            ["name" => "stuff-master", "description" => "Może edytować kartoteki narzędzi"],
            ["name" => "book-master", "description" => "Może edytować kartoteki książek"],
            ["name" => "specialist-master", "description" => "Może edytować kartoteki specjalistów"],
            ["name" => "film-master", "description" => "Może edytować kartoteki filmów"],
            ["name" => "blogger", "description" => "Ma dostęp do artykułów"],

            // user-related
            ["name" => "course-manager", "description" => "Może edytować kartoteki własnych kursów"],
            ["name" => "reviewer", "description" => "Może dawać oceny, recenzje i komentarze"],
        ]);

        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("role_name");
                $table->foreign("role_name")->references("name")->on("roles")->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
    }
};
