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
        Schema::create('order_pros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->index('order__pros_order_id_foreign');
            $table->unsignedBigInteger('product_id')->index('order__pros_product_id_foreign');
            $table->unsignedBigInteger('customer_id')->index('order__pros_customer_id_foreign');
            $table->float('price');
            $table->float('discount');
            $table->integer('count');
            $table->float('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_pros');
    }
};
