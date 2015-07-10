<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->integer('group_id')->default(0);
            $table->integer('parent')->default(0);
            $table->string('type');
            $table->string('open_type')->default('current');
            $table->integer('item_id');
            $table->string('link');
            $table->string('status')->default('enable');
            $table->integer('order')->default(0);
            $table->string('icon');
            $table->timestamps();
        });
        
        Schema::create('category_menu', function(Blueprint $table){
            $table->integer('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->integer('category_id')->references('id')->on('category')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menus');
        Schema::drop('category_menu');
    }
}
