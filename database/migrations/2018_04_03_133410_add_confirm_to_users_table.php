<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConfirmToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['created_at']);
            $table->dropColumn(['updated_at']);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('confirm_text')->nullable();
            $table->integer('confirm')->default(0)->notNull();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['confirm_text']);
            $table->dropColumn(['confirm']);
        });
    }
}
