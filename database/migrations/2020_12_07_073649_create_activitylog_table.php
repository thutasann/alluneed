<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitylogTable extends Migration
{
    
    public function up()
    {
        Schema::create('activitylog', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('prod_id')->nullable();
            $table->mediumText('description')->nullable();
            $table->mediumText('type');
            $table->tinyInteger('status')->default('0');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('activitylog');
    }
}
