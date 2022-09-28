<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductBannerOnesTable extends Migration
{
    public function up()
    {
        Schema::table('product_banner_ones', function (Blueprint $table) {
            $table->unsignedBigInteger('products_id')->nullable();
            $table->foreign('products_id', 'products_fk_7387661')->references('id')->on('products');
        });
    }
}
