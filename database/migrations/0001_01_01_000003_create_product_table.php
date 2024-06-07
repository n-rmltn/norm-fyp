<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_brand', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_brand_name');
            $table->timestamps();
        });

        Schema::create('product_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_category_name');
            $table->timestamps();
        });

        Schema::create('product_spec', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('product_spec_cat')->references('id')->on('product_category')->constrained();
            $table->string('product_spec_name');
            $table->timestamps();
        });

        Schema::create('product', function (Blueprint $table) {
            $table->id('id');
            $table->string('product_name');
            $table->foreignId('product_brand_id')->references('id')->on('product_brand')->constrained();
            $table->foreignId('product_category_id')->references('id')->on('product_category')->constrained();
            $table->foreignId('product_spec_id')->nullable()->references('id')->on('product_spec')->constrained();
            $table->string('product_cart_image_name')->nullable()->default(null);
            $table->text('product_description')->nullable()->default(null);
            $table->decimal('product_base_price', 8, 2)->nullable()->default('0.00');
            $table->integer('product_quantity');
            $table->boolean('product_availability')->default(1);
            $table->timestamps();
        });

        Schema::create('compatibility', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('motherboard')->references('id')->on('product_spec')->constrained();
            $table->foreignId('cpu')->references('id')->on('product_spec')->constrained();
            $table->foreignId('ram')->references('id')->on('product_spec')->constrained();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
        Schema::dropIfExists('compatibility');
        Schema::dropIfExists('product_spec');
        Schema::dropIfExists('product_category');
        Schema::dropIfExists('product_brand');
        Schema::dropIfExists('product_images');
    }
};
