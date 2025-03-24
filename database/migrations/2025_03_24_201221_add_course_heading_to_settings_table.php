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
        DB::table("settings")->insert([
            ["name" => "course_heading", "value" => "Wyszukiwarka aktualnych kursów i szkoleń dla logopedów dostępnych w Polsce!"],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table("settings")->where("name", "course_heading")->delete();
    }
};
