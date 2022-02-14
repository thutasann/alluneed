<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('like', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('prod_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('like');
    }
};
