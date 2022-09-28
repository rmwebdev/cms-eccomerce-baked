<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSpesialOffersTable extends Migration
{
    public function up()
    {
        Schema::table('spesial_offers', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_7387382')->references('id')->on('products');
        });
    }
}
