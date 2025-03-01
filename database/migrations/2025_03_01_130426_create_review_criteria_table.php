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
        Schema::create('review_criteria', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("visible")->default(2);
            $table->integer("order")->nullable();

            $table->text("description")->nullable();
            $table->json("options")->nullable();
            $table->boolean("used_in_courses")->default(true);

            $table->integer("created_by")->nullable();
            $table->integer("updated_by")->nullable();
            $table->timestamps();
        });

        Schema::create('review_review_criterion', function (Blueprint $table) {
            $table->id();
            $table->foreignId("review_criterion_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("review_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->text("answer")->nullable();
        });

        Schema::table("reviews", function (Blueprint $table) {
            $table->dropColumn(["title", "description", "rating"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("reviews", function (Blueprint $table) {
            $table->string("title")->nullable();
            $table->text("description")->nullable();
            $table->integer("rating");
        });

        Schema::dropIfExists('review_review_criterion');
        Schema::dropIfExists('review_criteria');
    }
};
