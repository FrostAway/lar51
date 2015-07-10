<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id');
            $table->string('src');
            $table->string('type', 60);
            $table->string('mime_type', 60);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('media');
//        Schema::table('media', function(Blueprint $table){
//            $table->string('name')->after('author_id');
//            $table->string('title')->after('name');
//        });
    }
}
