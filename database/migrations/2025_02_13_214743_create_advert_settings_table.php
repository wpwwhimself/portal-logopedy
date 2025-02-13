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
        Schema::create('advert_settings', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("ad_type");
            $table->text("value")->nullable();
            $table->timestamp("updated_at")->nullable();
            $table->foreignId("updated_by")->nullable()->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
        });

        DB::table("advert_settings")->insert([
            // thin bar
            ["ad_type" => "thin", "name" => "visible", "value" => "0", "updated_at" => null, "updated_by" => null],
            ["ad_type" => "thin", "name" => "content", "value" => null, "updated_at" => null, "updated_by" => null],
            ["ad_type" => "thin", "name" => "white_text", "value" => "0", "updated_at" => null, "updated_by" => null],
            ["ad_type" => "thin", "name" => "background-color", "value" => null, "updated_at" => null, "updated_by" => null],
            ["ad_type" => "thin", "name" => "link", "value" => null, "updated_at" => null, "updated_by" => null],
            // big bar
            ["ad_type" => "big", "name" => "visible", "value" => "0", "updated_at" => null, "updated_by" => null],
            ["ad_type" => "big", "name" => "image_path", "value" => null, "updated_at" => null, "updated_by" => null],
            ["ad_type" => "big", "name" => "link", "value" => null, "updated_at" => null, "updated_by" => null],
            // sidebar window
            ["ad_type" => "side", "name" => "visible", "value" => "0", "updated_at" => null, "updated_by" => null],
            ["ad_type" => "side", "name" => "image_path", "value" => null, "updated_at" => null, "updated_by" => null],
            ["ad_type" => "side", "name" => "link", "value" => null, "updated_at" => null, "updated_by" => null],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advert_settings');
    }
};
