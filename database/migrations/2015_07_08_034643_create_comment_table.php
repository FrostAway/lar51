<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function(Blueprint $table){
            $table->increments('id');
            $table->integer('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->integer('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('author_name');
            $table->string('author_email');
            $table->string('author_desc');
            $table->string('author_ip');
            $table->text('content');
            $table->string('status');
            $table->integer('parent');
            $table->string('agent');
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
        Schema::dropIfExists('comments');
    }
}
