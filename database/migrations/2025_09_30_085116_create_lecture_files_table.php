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
        Schema::create('lecture_files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('lecture_id')->index('lecture_files_lecture_id_foreign');
            $table->string('name')->nullable();
            $table->string('url')->nullable();
            $table->enum('type', ['1', '2'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecture_files');
    }
};
