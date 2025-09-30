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
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_ar');
            $table->string('title_en');
            $table->unsignedBigInteger('category_id')->default(1)->index('category_id');
            $table->string('slug_ar', 500)->nullable();
            $table->string('slug_en', 500)->nullable();
            $table->unsignedBigInteger('user_id')->index('blogs_user_id_foreign');
            $table->string('tag_ar', 500)->nullable();
            $table->string('tag_en', 500)->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
            $table->string('meta_description_en')->nullable();
            $table->string('meta_description_ar')->nullable();
            $table->text('overview_ar')->nullable();
            $table->text('overview_en')->nullable();
            $table->integer('views')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
