<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPersonalizedTwosTable extends Migration
{
    public function up()
    {
        Schema::table('personalized_twos', function (Blueprint $table) {
            $table->unsignedBigInteger('products_id')->nullable();
            $table->foreign('products_id', 'products_fk_7387645')->references('id')->on('products');
        });
    }
}
