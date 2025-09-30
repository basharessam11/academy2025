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
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('question_id')->index('answers_question_id_foreign');
            $table->unsignedBigInteger('customer_id')->index('answers_customer_id_foreign');
            $table->unsignedBigInteger('exam_id')->index('exam_id');
            $table->integer('type')->default(0);
            $table->text('answer');
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->unsignedBigInteger('customer_exams_id')->index('customer_exams_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
