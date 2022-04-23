<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->double('price');
            $table->string('category_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('type_coupon')->default(0)->comment('0 - order, 1 - category, 2 - product');
            $table->string('type')->default(1)->comment('0 - Fixed, 1 - Percentage');
            $table->unsignedInteger('used_count');
            $table->timestamps();

//            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
//            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupon_products');
    }
}
