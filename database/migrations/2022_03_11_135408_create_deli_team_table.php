<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('deli_team', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id');
            $table->integer('branch_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->mediumText('schedule');
            $table->tinyInteger('status')->default('0');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('deli_team');
    }
};
