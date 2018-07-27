<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserAgentToSpOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sp_orders', function (Blueprint $table) {
            $table->string('ip')->nullable();
            $table->string('country')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('sc_userid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sp_orders', function (Blueprint $table) {
            $table->dropColumn(['ip','country', 'user_agent', 'sc_userid']);
        });
    }
}
