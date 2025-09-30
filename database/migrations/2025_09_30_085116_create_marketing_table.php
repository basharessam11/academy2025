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
        Schema::create('marketing', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->string('name');
            $table->string('location');
            $table->string('phone', 50);
            $table->integer('contact_method')->default(2);
            $table->string('education');
            $table->string('note')->nullable();
            $table->integer('status')->default(0);
            $table->unsignedBigInteger('user_id')->index('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketing');
    }
};
