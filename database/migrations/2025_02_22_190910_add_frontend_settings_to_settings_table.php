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
            ["name" => "app_logo_mono_path", "value" => null],
            ["name" => "welcome_banner_path", "value" => null],
            ["name" => "main_tile_1_icon_path", "value" => null],
            ["name" => "main_tile_2_icon_path", "value" => null],
            ["name" => "main_tile_3_icon_path", "value" => null],
            ["name" => "main_tile_4_icon_path", "value" => null],
            ["name" => "main_tile_5_icon_path", "value" => null],
            ["name" => "main_tile_6_icon_path", "value" => null],
        ]);

        DB::table("advert_settings")->where("ad_type", "side")->delete();
        DB::table("advert_settings")->where("ad_type", "big")->whereIn("name", ["image_path", "link"])->delete();
        DB::table("advert_settings")->insert([
            // lower thin bar
            ["ad_type" => "lower_thin", "name" => "visible", "value" => "0", "updated_at" => null, "updated_by" => null],
            ["ad_type" => "lower_thin", "name" => "content", "value" => null, "updated_at" => null, "updated_by" => null],
            ["ad_type" => "lower_thin", "name" => "white_text", "value" => "0", "updated_at" => null, "updated_by" => null],
            ["ad_type" => "lower_thin", "name" => "background-color", "value" => null, "updated_at" => null, "updated_by" => null],
            ["ad_type" => "lower_thin", "name" => "link", "value" => null, "updated_at" => null, "updated_by" => null],
            // big bar - carousel
            ["ad_type" => "big", "name" => "images_and_links", "value" => null, "updated_at" => null, "updated_by" => null],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table("settings")->whereIn("name", [
            "app_logo_mono_path",
            "welcome_banner_path",
            "main_tile_1_icon_path",
            "main_tile_2_icon_path",
            "main_tile_3_icon_path",
            "main_tile_4_icon_path",
            "main_tile_5_icon_path",
            "main_tile_6_icon_path",
        ])->delete();

        DB::table("advert_settings")->where("ad_type", "lower_thin")->delete();
        DB::table("advert_settings")->where("ad_type", "big")->whereIn("name", ["images_and_links"])->delete();
        DB::table("advert_settings")->insert([
            // sidebar window
            ["ad_type" => "side", "name" => "visible", "value" => "0", "updated_at" => null, "updated_by" => null],
            ["ad_type" => "side", "name" => "image_path", "value" => null, "updated_at" => null, "updated_by" => null],
            ["ad_type" => "side", "name" => "link", "value" => null, "updated_at" => null, "updated_by" => null],
            // big bar
            ["ad_type" => "big", "name" => "image_path", "value" => null, "updated_at" => null, "updated_by" => null],
            ["ad_type" => "big", "name" => "link", "value" => null, "updated_at" => null, "updated_by" => null],
        ]);
    }
};
