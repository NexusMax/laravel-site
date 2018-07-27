<?php
/**
 * Created by PhpStorm.
 * User: AndriiK
 * Date: 18.12.2017
 * Time: 13:27
 */
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_images', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('gallery_id')->unsigned();
            $table->string('image');
            $table->string('description');
            $table->foreign('gallery_id')->references('id')->on('photo_galleries')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::drop('photo_images');
    }
}
