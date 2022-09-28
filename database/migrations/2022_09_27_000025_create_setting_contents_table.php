<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingContentsTable extends Migration
{
    public function up()
    {
        Schema::create('setting_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tag_line_product')->nullable();
            $table->string('url_video')->nullable();
            $table->timestamps();
        });
    }
}
