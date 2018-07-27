<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribersGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribers_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('list_id')->unique()->null();
            $table->string('web_id')->unique()->null();
            $table->string('visibility')->null();
            $table->json('json')->null();
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
        Schema::dropIfExists('subscribers_groups');
    }
}
