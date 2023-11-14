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
        Schema::create('packet_prices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('price_in_dollars')->nullable();
            $table->bigInteger('price_in_rupiah')->nullable();
            $table->bigInteger('price_tourist_in_dollars')->nullable();
            $table->bigInteger('price_tourist_in_rupiah')->nullable();
            $table->bigInteger('fee_in_dollars')->nullable();
            $table->bigInteger('fee_in_rupiah')->nullable();
            $table->bigInteger('discount_in_dollars')->nullable();
            $table->bigInteger('discount_in_rupiah')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('type', 100)->nullable();

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
        Schema::dropIfExists('packet_prices');
    }
};
