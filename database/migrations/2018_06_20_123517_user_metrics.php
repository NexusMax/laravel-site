<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserMetrics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Remove unnecessary fields form extra_user
        Schema::table('extra_user', function (Blueprint $table) {
            $table->dropColumn(['physical_test']);
            $table->dropColumn(['health_test']);
        });

        Schema::create('physical_metrics_history', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('ruffier_p1');
            $table->integer('ruffier_p2');
            $table->integer('ruffier_p3');
            $table->integer('ruffier_index');

            $table->enum('flexibility',[1,2,3]);

            $table->integer('pushups');
            $table->integer('twisting');
            $table->integer('situp');
            $table->integer('plank');

            $table->enum('swallow',[1,2,3]);

            $table->text('result');

            $table->timestamps();
        });

        Schema::create('health_metrics_history', function (Blueprint $table) {
            $table->increments('id');



            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('growth');
            $table->integer('height');
            $table->integer('pressure_sys');
            $table->integer('pressure_dia');

            $table->integer('smoking');
            $table->integer('alcohol');

            $table->integer('pulse_rest');
            $table->integer('pulse_regen');

            $table->enum('stamina',[1,2,3,4,5,6]);
            $table->text('result');

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
        Schema::table('extra_user', function (Blueprint $table) {
            $table->text('physical_test');
            $table->text('health_test');
        });

        Schema::dropIfExists('physical_metrics_history');
        Schema::dropIfExists('health_metrics_history');



    }
}
