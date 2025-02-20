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
        Schema::create('industries', function (Blueprint $table) {
            $table->id();
            $table->string("name");

            $table->string("description")->nullable();

            $table->foreignId("created_by")->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("updated_by")->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });

        Schema::create('industriables', function (Blueprint $table) {
            $table->foreignId("industry_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->morphs("industriable");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('industriables');
        Schema::dropIfExists('industries');
    }
};
