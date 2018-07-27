<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUpdatedAtwithToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sp_items_events', function (Blueprint $table) {
            $table->dropColumn(['created_at']);
        });
        Schema::table('sp_items_events', function (Blueprint $table) {
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
        Schema::table('sp_items_events', function (Blueprint $table) {
            $table->dropColumn(['created_at']);
        });
    }
}
