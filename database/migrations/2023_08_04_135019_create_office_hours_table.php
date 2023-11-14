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
        Schema::create('office_hours', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('about_us_id',36);
            $table->foreign('about_us_id')->references('id')->on('about_us');
            
            $table->string('day', 100)->nullable();
            $table->string('time', 100)->nullable();
            $table->string('note', 200)->nullable();
            $table->integer('status')->nullable();

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
        Schema::dropIfExists('office_hours');
    }
};
