<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNameWithToCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('sp_categories', function (Blueprint $table) {
//            $table->string('name_article')->nullable();
//            $table->string('name_briefcases')->nullable();
//            $table->string('name_video')->nullable();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('sp_categories', function (Blueprint $table) {
//            $table->dropColumn(['name_article', 'name_briefcases', 'name_video']);
//        });
    }
}
