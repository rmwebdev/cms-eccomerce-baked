<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpesialOffersTable extends Migration
{
    public function up()
    {
        Schema::create('spesial_offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description')->nullable();
            $table->integer('discount')->nullable();
            $table->timestamps();
        });
    }
}
