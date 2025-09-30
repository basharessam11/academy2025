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
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('counter1')->default(0);
            $table->integer('counter2')->default(0);
            $table->integer('counter3')->default(0);
            $table->integer('counter4')->default(0);
            $table->text('photo')->nullable();
            $table->timestamps();
            $table->string('phone', 13);
            $table->string('email', 100);
            $table->string('location');
            $table->string('facebook');
            $table->string('x');
            $table->string('youtube');
            $table->string('instagram');
            $table->string('name');
            $table->string('ZOOM_ACCOUNT_ID');
            $table->string('ZOOM_CLIENT_SECRET');
            $table->string('ZOOM_CLIENT_KEY');
            $table->string('photo_about')->nullable();
            $table->string('photo_services')->nullable();
            $table->string('photo_products')->nullable();
            $table->string('photo_faq')->nullable();
            $table->string('photo_contact')->nullable();
            $table->string('color', 50);
            $table->string('background_color', 50)->nullable();
            $table->string('color_h', 50);
            $table->string('color_header', 50);
            $table->integer('Blogs')->default(1);
            $table->integer('Story')->default(1);
            $table->integer('About')->default(1);
            $table->integer('Services')->default(1);
            $table->integer('FAQ')->default(1);
            $table->integer('Contact')->default(1);
            $table->integer('Products')->default(1);
            $table->integer('Sessions')->default(1);
            $table->longText('marketing_contant')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
