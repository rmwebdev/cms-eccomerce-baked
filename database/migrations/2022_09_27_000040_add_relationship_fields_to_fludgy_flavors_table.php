<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFludgyFlavorsTable extends Migration
{
    public function up()
    {
        Schema::table('fludgy_flavors', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_7387551')->references('id')->on('products');
        });
    }
}
