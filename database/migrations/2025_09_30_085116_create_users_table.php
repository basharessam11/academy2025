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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name_ar');
            $table->string('name_en');
            $table->text('meta_description_ar')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->string('email')->unique('email');
            $table->string('phone', 50)->nullable()->unique('phone');
            $table->unsignedBigInteger('country_id')->default(1)->index('country_id');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('photo')->nullable();
            $table->integer('role')->default(2);
            $table->string('specialty')->nullable();
            $table->integer('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
