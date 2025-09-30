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
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email', 150);
            $table->string('password');
            $table->string('status')->nullable()->default('1');
            $table->string('phone')->nullable();
            $table->integer('age')->nullable();
            $table->unsignedBigInteger('country_id')->index('customers_country_id_foreign');
            $table->string('photo')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->rememberToken();
            $table->integer('user_type')->default(1);
            $table->unsignedBigInteger('group_id')->default(1)->index('group_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
