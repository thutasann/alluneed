<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('subcategorys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('name');
            $table->string('url');
            $table->mediumText('description');
            $table->string('image');
            $table->tinyInteger('priority')->default('0');
            $table->tinyInteger('status')->default('0');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('subcategorys');
    }
};
