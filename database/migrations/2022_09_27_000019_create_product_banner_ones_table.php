<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBannerOnesTable extends Migration
{
    public function up()
    {
        Schema::create('product_banner_ones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tittle_banner')->nullable();
            $table->integer('discount')->nullable();
            $table->timestamps();
        });
    }
}
