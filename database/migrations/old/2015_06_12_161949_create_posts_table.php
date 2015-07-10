<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('post_title');
            $table->string('slug');
            $table->string('image_url');
            $table->longText('post_content');
            $table->text('post_excerpt');
            $table->integer('author_id');
            $table->string('post_status', 40)->default('publish');
            $table->string('comment_status')->default('open');
            $table->integer('comment_count')->default(0);
            $table->string('post_type')->default('post');
            $table->timestamps();
        });
        
        Schema::create('postmeta', function(Blueprint $table){
            $table->increments('id');
            $table->integer('post_id');
            $table->string('key');
            $table->text('value');
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
        Schema::dropIfExists('posts');
         Schema::dropIfExists('postmeta');
    }
}
