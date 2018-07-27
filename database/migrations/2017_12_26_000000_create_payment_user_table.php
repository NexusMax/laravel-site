<?php
/**
 * Created by PhpStorm.
 * User: AndriiK
 * Date: 26.12.2017
 * Time: 15:03
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('payment_id');
            $table->integer('paid')->default(1);
            $table->dateTime('dt');
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
        Schema::drop('payment_user');
    }
}
