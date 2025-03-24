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
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("visible")->default(2);
            $table->integer("order")->nullable();

            $table->json("categories")->nullable();
            $table->text("description")->nullable();
            $table->json("keywords")->nullable();
            $table->string("thumbnail_path")->nullable();
            $table->string("link")->nullable();

            $table->foreignId("created_by")->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("updated_by")->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("deleted_by")->nullable()->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('films');
    }
};
