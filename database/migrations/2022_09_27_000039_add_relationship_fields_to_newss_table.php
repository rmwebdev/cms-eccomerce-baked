<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToNewssTable extends Migration
{
    public function up()
    {
        Schema::table('newss', function (Blueprint $table) {
            $table->unsignedBigInteger('tags_id')->nullable();
            $table->foreign('tags_id', 'tags_fk_7387449')->references('id')->on('news_tags');
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id', 'author_fk_7387450')->references('id')->on('users');
        });
    }
}
