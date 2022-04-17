<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('provider_id');
            $table->string('provider_name');
            $table->string('user_name');
            $table->string('user_phone');
            $table->string('product_name')->nullable();
            $table->string('product_description')->nullable();
            $table->double('product_price')->nullable();
            $table->string('product_image')->nullable();
            $table->string('payment_type')->nullable();
            $table->unsignedBigInteger('quantity')->default(1);
            $table->double('discount')->nullable();
            $table->double('total_amount')->default(0);
            $table->string('arrival_time');
            $table->string('status');
            $table->string('address');
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
        Schema::dropIfExists('orders');
    }
}
