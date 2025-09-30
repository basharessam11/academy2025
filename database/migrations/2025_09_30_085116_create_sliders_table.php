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
        Schema::create('sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('title_ar1')->nullable();
            $table->string('title_en1')->nullable();
            $table->text('description_ar');
            $table->text('description_en');
            $table->string('description_ar1')->nullable();
            $table->string('description_en1')->nullable();
            $table->text('photo')->nullable();
            $table->timestamps();
            $table->integer('counter')->default(0);
            $table->integer('rate')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
