<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateSlidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slides', function(Blueprint $table){
            $table->increments('id');
            $table->integer('slider_id')->default(0);
            $table->string('name');
            $table->string('desc');
            $table->string('slug');
            $table->string('image');
            $table->string('link');
            $table->string('open_type', 20);
            $table->integer('order')->default(9999999);
            $table->text('params');
            $table->text('layers');
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
        Schema::dropIfExists('slides');
    }
}
