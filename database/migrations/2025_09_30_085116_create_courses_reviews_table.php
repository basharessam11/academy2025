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
        Schema::create('courses_reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('course_id')->index('courses_reviews_course_id_foreign');
            $table->unsignedBigInteger('customer_id')->index('customer_id');
            $table->double('rate');
            $table->string('review');
            $table->string('ip_address')->nullable();
            $table->string('name');
            $table->string('email');
            $table->timestamps();
            $table->integer('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses_reviews');
    }
};
