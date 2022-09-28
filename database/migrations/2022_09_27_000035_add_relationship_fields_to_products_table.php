<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('user_create_id')->nullable();
            $table->foreign('user_create_id', 'user_create_fk_7387141')->references('id')->on('users');
            $table->unsignedBigInteger('user_update_id')->nullable();
            $table->foreign('user_update_id', 'user_update_fk_7387142')->references('id')->on('users');
        });
    }
}
