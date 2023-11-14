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
        Schema::create('request_trips', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('destination_request', 100)->nullable();
            $table->date('departure_date')->nullable();
            $table->integer('duration_trip')->nullable();
            $table->integer('number_of_participant')->nullable();
            $table->string('currency', 50)->nullable();
            $table->bigInteger('budget_trip')->nullable();
            $table->text('note')->nullable();
            $table->string('status', 50)->nullable();
            $table->integer('approval')->nullable();
            
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
        Schema::dropIfExists('request_trips');
    }
};
