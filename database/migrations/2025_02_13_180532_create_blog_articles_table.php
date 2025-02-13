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
        Schema::create('blog_articles', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("visible")->default(2);
            $table->integer("order")->nullable();
            $table->string("banner_path")->nullable();
            $table->text("header_paragraph")->nullable();
            $table->text("content")->nullable();
            $table->string("outside_link")->nullable();
            $table->timestamps();
            $table->foreignId("created_by")->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("updated_by")->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
        });

        DB::table("settings")->insert([
            ["name" => "blog_name", "value" => "Blog Portalu Logopedy"],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table("settings")->whereIn("name", [
            "blog_name",
        ]);

        Schema::dropIfExists('blog_articles');
    }
};
