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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_ar');
            $table->string('title_en');
            $table->integer('quantity')->default(1);
            $table->integer('price')->default(1);
            $table->integer('price1')->default(1);
            $table->string('slug_ar')->nullable();
            $table->string('slug_en')->nullable();
            $table->text('overview_ar')->nullable();
            $table->text('overview_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->text('photo')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->integer('tax');
            $table->integer('tax1')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
