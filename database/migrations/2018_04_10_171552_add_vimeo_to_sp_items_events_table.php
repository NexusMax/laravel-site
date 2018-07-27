<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVimeoToSpItemsEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sp_items_events', function (Blueprint $table) {
            $table->text('vimeo' );
            $table->decimal('price' )->default(0.00);
            $table->integer('count_people' )->default(0);
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
            $table->dropColumn(['vimeo']);
            $table->dropColumn(['price']);
            $table->dropColumn(['count_people']);
        });
    }
}
