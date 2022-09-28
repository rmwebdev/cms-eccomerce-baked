<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalizedTreesTable extends Migration
{
    public function up()
    {
        Schema::create('personalized_trees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('discount')->nullable();
            $table->timestamps();
        });
    }
}
