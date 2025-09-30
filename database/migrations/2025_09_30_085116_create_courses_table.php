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
            $table->bigIncrements('id');
            $table->string('title_ar');
            $table->string('title_en');
            $table->integer('price')->default(1);
            $table->integer('price_online')->default(0);
            $table->integer('discount')->default(0);
            $table->date('discount_date')->nullable();
            $table->integer('discount_rate')->default(0);
            $table->string('slug_ar')->nullable();
            $table->string('slug_en')->nullable();
            $table->unsignedBigInteger('user_id')->index('courses_user_id_foreign');
            $table->text('overview_ar')->nullable();
            $table->text('overview_en')->nullable();
            $table->text('photo')->nullable();
            $table->string('video')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->integer('tax')->default(0);
            $table->integer('tax1')->default(0);
            $table->string('meta_description_en');
            $table->string('meta_description_ar');
            $table->integer('status')->default(1);
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
