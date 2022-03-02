<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('coupon_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('coupon_id')->default('0');
            $table->string('user_email')->default('0');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coupon_user');
    }
};
