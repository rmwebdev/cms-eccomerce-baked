<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutImagesTable extends Migration
{
    public function up()
    {
        Schema::create('about_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('sub_tittle');
            $table->timestamps();
        });
    }
}
