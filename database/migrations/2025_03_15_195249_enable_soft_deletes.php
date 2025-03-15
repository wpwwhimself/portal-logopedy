<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table("blog_articles", function (Blueprint $table) {
            $table->softDeletes()->after("updated_at");
            $table->foreignId("deleted_by")->after("updated_by")->nullable()->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
        });
        Schema::table("courses", function (Blueprint $table) {
            $table->softDeletes()->after("updated_at");
            $table->foreignId("deleted_by")->after("updated_by")->nullable()->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
        });
        Schema::table("reviews", function (Blueprint $table) {
            $table->softDeletes()->after("updated_at");
        });
        Schema::table("standard_pages", function (Blueprint $table) {
            $table->softDeletes()->after("updated_at");
        });
        Schema::table("universities", function (Blueprint $table) {
            $table->softDeletes()->after("updated_at");
            $table->foreignId("deleted_by")->after("updated_by")->nullable()->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
        });
        Schema::table("users", function (Blueprint $table) {
            $table->softDeletes()->after("updated_at");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("blog_articles", function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn("deleted_by");
        });
        Schema::table("courses", function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn("deleted_by");
        });
        Schema::table("reviews", function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table("standard_pages", function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table("universities", function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropColumn("deleted_by");
        });
        Schema::table("users", function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
