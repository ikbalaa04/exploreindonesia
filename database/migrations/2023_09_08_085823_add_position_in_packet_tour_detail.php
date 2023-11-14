<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packet_tour_details', function (Blueprint $table) {
            $table->integer('position')->unsigned()->nullable()->after('packet_id');
            $table->string('status', 100)->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packet_tour_details', function (Blueprint $table) {
            $table->dropColumn('position');
            $table->dropColumn('status');
        });
    }
};
