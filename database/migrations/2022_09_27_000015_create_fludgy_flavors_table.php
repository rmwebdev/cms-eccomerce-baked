<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFludgyFlavorsTable extends Migration
{
    public function up()
    {
        Schema::create('fludgy_flavors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('banner_tittle')->nullable();
            $table->timestamps();
        });
    }
}
