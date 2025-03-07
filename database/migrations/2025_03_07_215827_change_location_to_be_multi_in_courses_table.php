<?php

use App\Models\Course;
use App\Models\University;
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
        Schema::table('courses', function (Blueprint $table) {
            $table->json("locations")->before("dates")->nullable();
        });

        Course::whereNotNull("location")->update([
            "locations" => DB::raw("JSON_ARRAY(location)")
        ]);

        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn("location");
        });

        //

        Schema::table('universities', function (Blueprint $table) {
            $table->json("locations")->before("cost")->nullable();
        });

        University::whereNotNull("location")->update([
            "locations" => DB::raw("JSON_ARRAY(location)")
        ]);

        Schema::table('universities', function (Blueprint $table) {
            $table->dropColumn("location");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->string("location")->before("dates")->nullable();
        });

        Course::whereNotNull("locations")->update([
            "location" => DB::raw("JSON_EXTRACT(locations, '$[0]')")
        ]);

        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn("locations");
        });

        //

        Schema::table('universities', function (Blueprint $table) {
            $table->string("location")->before("cost")->nullable();
        });

        University::whereNotNull("locations")->update([
            "location" => DB::raw("JSON_EXTRACT(locations, '$[0]')")
        ]);

        Schema::table('universities', function (Blueprint $table) {
            $table->dropColumn("locations");
        });
    }
};
