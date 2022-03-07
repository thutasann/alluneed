<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('tracking_no');
            $table->string('tracking_msg')->nullable();
            $table->string('payment_mode');
            $table->string('payment_id')->nullable();
            $table->tinyInteger('payment_status')->default('0');
            $table->tinyInteger('order_status')->default('0');
            $table->string('cancel_reason')->nullable();
            $table->string('notify')->default('0');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
