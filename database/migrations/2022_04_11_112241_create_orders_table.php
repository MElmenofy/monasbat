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
            $table->text('product_name', 1000)->nullable();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->string('product_description')->nullable();
            $table->double('product_price')->nullable();
            $table->double('product_tax')->nullable();
            $table->string('product_image')->nullable();
            $table->string('payment_type')->nullable();
            $table->unsignedBigInteger('quantity')->default(1);
            $table->double('discount')->nullable();
            $table->double('total_amount')->default(0);
            $table->double('all_cost_after_discount_and_shipping')->default(0);
            $table->string('arrival_time');
            $table->string('status');
            $table->string('comment')->nullable();
            $table->string('address');
            $table->string('shipping_name');
            $table->string('shipping_cost');
            $table->string('is_admin')->nullable();
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
