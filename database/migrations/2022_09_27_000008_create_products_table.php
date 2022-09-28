<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable()->unique();
            $table->longText('description')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->string('short_description')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->decimal('price_new', 15, 2)->nullable();
            $table->integer('discount')->nullable();
            $table->date('expired_date')->nullable();
            $table->timestamps();
        });
    }
}
