<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('request_vendor', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('vendor_name');
            $table->mediumText('description')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->tinyInteger('confirm')->default('0');
            $table->string('payment_mode');
            $table->string('payment_id')->nullable();
            $table->tinyInteger('payment_status')->default('0');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('request_vendor');
    }
};
