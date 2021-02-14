<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('offer_name');
            $table->string('product_id')->default('0');
            $table->string('coupon_code');
            $table->string('coupon_limit');
            $table->string('coupon_type');
            $table->string('coupon_price');
            $table->dateTime('start_datetime');
            $table->dateTime('end_datetime');
            $table->tinyInteger('status')->default('0');
            $table->tinyInteger('visibility_status')->default('0');
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
        Schema::dropIfExists('coupons');
    }
}
