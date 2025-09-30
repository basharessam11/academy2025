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
        Schema::create('rateings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('photo')->nullable();
            $table->timestamps();
            $table->text('review');
            $table->string('name', 100);
            $table->integer('rate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rateings');
    }
};
