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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("visible")->default(2);
            $table->integer("order")->nullable();

            $table->string("category");
            $table->string("subcategory")->nullable();
            $table->text("description")->nullable();
            $table->string("thumbnail_path")->nullable();
            $table->string("link")->nullable();
            $table->string("trainer_name")->nullable();
            $table->string("trainer_organization")->nullable();
            $table->string("location")->nullable();
            $table->string("cost")->nullable();
            $table->string("final_document")->nullable();

            $table->foreignId("created_by")->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("updated_by")->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
