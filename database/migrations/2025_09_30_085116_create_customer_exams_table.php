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
        Schema::create('customer_exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('customer_id')->index('customer_exams_customer_id_foreign');
            $table->unsignedBigInteger('exam_id')->index('customer_exams_exam_id_foreign');
            $table->unsignedBigInteger('user_id')->default(2)->index('user_id');
            $table->time('time')->default('00:00:00');
            $table->timestamps();
            $table->integer('status')->default(0);
            $table->float('rate')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_exams');
    }
};
