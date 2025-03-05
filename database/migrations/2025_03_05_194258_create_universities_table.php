<?php

use App\Models\Role;
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
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("visible")->default(2);
            $table->integer("order")->nullable();

            $table->json("categories")->nullable();
            $table->text("description")->nullable();
            $table->json("keywords")->nullable();
            $table->string("thumbnail_path")->nullable();
            $table->json("image_paths")->nullable();
            $table->string("link")->nullable();
            $table->string("location")->nullable();
            $table->string("cost")->nullable();

            $table->foreignId("created_by")->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("updated_by")->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });

        Role::find("specialist-master")->update(["name" => "university-master"]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('universities');
        Role::find("university-master")->update(["name" => "specialist-master"]);
    }
};
