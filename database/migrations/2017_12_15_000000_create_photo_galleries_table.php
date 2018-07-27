<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_galleries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('cover_image');
            $table->string('alias');
            $table->string('meta_title');
            $table->string('meta_content');
            $table->integer('rows');
            $table->integer('cols');
            $table->integer('width');
            $table->integer('height');
            $table->string('popup');
            $table->integer('created_by');
            $table->boolean('published');
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
        Schema::drop('photo_galleries');
    }
}
