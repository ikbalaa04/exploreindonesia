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
        Schema::create('packet_tour_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('packet_id',36)->nullable();
            $table->foreign('packet_id')->references('id')->on('packets');
            $table->string('title', 100);
            $table->text('file')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('packet_tour_details');
    }
};
