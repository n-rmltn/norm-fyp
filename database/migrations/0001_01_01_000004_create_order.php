<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('product_id')->references('id')->on('product')->constrained();
            $table->foreignId('users_id')->references('id')->on('users')->constrained();
            $table->enum('order_status', ['Pending', 'Accepted', 'Rejected', 'Cancelled'])->default('Pending');
            $table->integer('order_quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
};
