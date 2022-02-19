<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('vendor_id');
            $table->mediumText('heading');
            $table->mediumText('description')->nullable();
            $table->mediumText('link')->nullable();
            $table->string('link_name')->nullable();
            $table->string('image');
            $table->tinyInteger('status')->default('0')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('sliders');
    }
};
