<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('user_create_id')->nullable();
            $table->foreign('user_create_id', 'user_create_fk_7387117')->references('id')->on('users');
            $table->unsignedBigInteger('user_update_id')->nullable();
            $table->foreign('user_update_id', 'user_update_fk_7387118')->references('id')->on('product_categories');
        });
    }
}
