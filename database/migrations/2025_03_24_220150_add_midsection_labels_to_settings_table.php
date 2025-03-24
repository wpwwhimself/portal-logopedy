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
            ["name" => "nav_labels", "value" => null],
            ["name" => "newsletter_button_text", "value" => "**Zapisz się na newsletter**, żeby dowiedzieć się, co dla Ciebie przygotowaliśmy!"],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table("settings")->whereIn("name", [
            "nav_labels",
            "newsletter_button_text",
        ])->delete();
    }
};
