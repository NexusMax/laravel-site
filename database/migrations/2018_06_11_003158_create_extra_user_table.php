<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExtraUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('nickname');
            $table->string('growth');
            $table->string('weight');
            $table->string('goal');
            $table->enum('physical_level',[1,2,3]);
            $table->text('physical_days');
            $table->text('physical_exp_years');
            $table->text('physical_test');
            $table->enum('health_level',[1,2,3]);
            $table->text('health_musculoskeletal');
            $table->text('health_cardio');
            $table->string('health_cardio_custom');
            $table->text('health_metabolism');
            $table->text('health_nervous');
            $table->string('health_nervous_custom');
            $table->boolean('health_pregnancy');
            $table->text('health_test');
            $table->enum('body_type',[1,2,3]);
            $table->enum('wrist_size',[1,2,3]);

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
        Schema::dropIfExists('extra_user');
    }
}
