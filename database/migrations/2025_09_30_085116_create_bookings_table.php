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
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('course_id')->index('idx_course_id');
            $table->unsignedBigInteger('customer_id')->index('idx_customer_id');
            $table->timestamps();
            $table->integer('total');
            $table->integer('discount')->default(0);
            $table->integer('type')->default(1);
            $table->string('note')->nullable();
            $table->integer('installment')->default(1);
            $table->integer('price')->default(0);
            $table->integer('remaining')->default(0);
            $table->string('photo')->nullable();
            $table->integer('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
