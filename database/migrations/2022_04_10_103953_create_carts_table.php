<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('quantity')->default(1);
            $table->double('total_amount')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->double('price');
            $table->double('discount')->nullable();
            $table->boolean('is_coupon')->nullable();
            $table->string('image');
            $table->string('service_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('provider_id');
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
        Schema::dropIfExists('carts');
    }
}
