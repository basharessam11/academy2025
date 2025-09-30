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
        Schema::create('metas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('about_title_ar');
            $table->string('about_title_en');
            $table->string('about_description_ar')->nullable();
            $table->string('about_description_en')->nullable();
            $table->string('policies_title_ar');
            $table->string('policies_title_en');
            $table->string('policies_description_ar')->nullable();
            $table->string('policies_description_en')->nullable();
            $table->string('index_title_ar');
            $table->string('index_title_en');
            $table->string('index_description_ar')->nullable();
            $table->string('index_description_en')->nullable();
            $table->string('courses_title_ar');
            $table->string('courses_title_en');
            $table->string('courses_description_ar')->nullable();
            $table->string('courses_description_en')->nullable();
            $table->string('blog_title_ar');
            $table->string('blog_title_en');
            $table->string('blog_description_ar')->nullable();
            $table->string('blog_description_en')->nullable();
            $table->timestamps();
            $table->string('login_title_ar');
            $table->string('login_title_en');
            $table->string('login_description_ar')->nullable();
            $table->string('login_description_en')->nullable();
            $table->string('registr_title_ar');
            $table->string('registr_title_en');
            $table->string('registr_description_ar')->nullable();
            $table->string('registr_description_en')->nullable();
            $table->string('teacher_title_ar')->nullable();
            $table->string('teacher_title_en')->nullable();
            $table->string('teacher_description_ar')->nullable();
            $table->string('teacher_description_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metas');
    }
};
