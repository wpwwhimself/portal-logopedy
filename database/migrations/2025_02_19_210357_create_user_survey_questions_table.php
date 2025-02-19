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
        Schema::create('user_survey_questions', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("visible")->default(2);
            $table->integer("order")->nullable();

            $table->text("description")->nullable();
            $table->json("options")->nullable();

            $table->timestamps();
        });

        Schema::create("user_user_survey_question", function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_survey_question_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("user_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->text("answer")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("user_user_survey_question");
        Schema::dropIfExists('user_survey_questions');
    }
};
