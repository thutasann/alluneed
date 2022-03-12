<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('shipping', function (Blueprint $table) {
            $table->increments('id');
            $table->string('shipping_tracking_no');
            $table->date('shipping_date');
            $table->integer('vendor_id');
            $table->integer('team_id');
            $table->integer('order_id');
            $table->date('received_date')->nullable();
            $table->integer('receiver_id')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipping');
    }
};
