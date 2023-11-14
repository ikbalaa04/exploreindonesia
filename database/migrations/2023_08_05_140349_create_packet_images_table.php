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
        Schema::create('packet_images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('packet_id',36)->nullable();
            $table->foreign('packet_id')->references('id')->on('packets');
            // $table->char('partner_id',36)->nullable();
            // $table->foreign('partner_id')->references('id')->on('partners');
            $table->string('name', 100)->nullable();
            $table->text('file')->nullable();
            $table->string('type', 50)->nullable();
            $table->integer('position')->unsigned()->nullable();
            
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
        Schema::dropIfExists('packet_images');
    }
};
