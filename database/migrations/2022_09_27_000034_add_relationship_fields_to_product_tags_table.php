<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProductTagsTable extends Migration
{
    public function up()
    {
        Schema::table('product_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('user_create_id')->nullable();
            $table->foreign('user_create_id', 'user_create_fk_7387120')->references('id')->on('users');
            $table->unsignedBigInteger('user_update_id')->nullable();
            $table->foreign('user_update_id', 'user_update_fk_7387121')->references('id')->on('users');
        });
    }
}
