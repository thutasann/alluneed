<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('url');
            $table->mediumText('descrip');
            $table->tinyInteger('status')->default('0');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('groups');
    }
};
