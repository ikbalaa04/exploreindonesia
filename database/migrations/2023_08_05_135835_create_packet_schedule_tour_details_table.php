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
        Schema::create('packet_schedule_tour_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('packet_schedule_tour_id',36)->nullable();
            $table->foreign('packet_schedule_tour_id')->references('id')->on('packet_schedule_tours');
            $table->string('name', 150)->nullable();
            $table->string('range_time', 150)->nullable();
            $table->text('detail')->nullable();
            $table->string('guide', 100)->nullable();

            
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
        Schema::dropIfExists('packet_schedule_tour_details');
    }
};
