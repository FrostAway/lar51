<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('type')->default('cat');
            $table->integer('parent');
            $table->integer('order');
            $table->integer('count');
            $table->timestamps();
        });
        
        Schema::create('category_post', function(Blueprint $table){
            $table->integer('post_id')->references('id')->on('post')->onDelete('cascade');
            $table->integer('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('category');
        Schema::drop('category_post');
    }
}
