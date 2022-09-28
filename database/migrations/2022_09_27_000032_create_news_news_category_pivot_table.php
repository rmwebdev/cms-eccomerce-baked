<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsNewsCategoryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('news_news_category', function (Blueprint $table) {
            $table->unsignedBigInteger('news_id');
            $table->foreign('news_id', 'news_id_fk_7387448')->references('id')->on('newss')->onDelete('cascade');
            $table->unsignedBigInteger('news_category_id');
            $table->foreign('news_category_id', 'news_category_id_fk_7387448')->references('id')->on('news_categories')->onDelete('cascade');
        });
    }
}
