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
        Schema::create('packets', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('zone_id',36)->nullable();
            $table->foreign('zone_id')->references('id')->on('zones');
            $table->text('categories_id')->nullable();
            $table->char('partner_id',36)->nullable();
            $table->foreign('partner_id')->references('id')->on('partners');
            $table->char('province_id',36)->nullable();
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->char('available_id',36)->nullable();
            $table->foreign('available_id')->references('id')->on('availables');
            $table->char('price_id',36)->nullable();
            $table->foreign('price_id')->references('id')->on('packet_prices');

            $table->integer('different_prices_for_tourists')->unsigned()->nullable();
            $table->string('title_idn', 100)->nullable();
            $table->string('title_en', 100)->nullable();
            $table->string('short_description_idn', 254)->nullable();
            $table->string('short_description_en', 254)->nullable();
            $table->longText('description_idn')->nullable();
            $table->longText('description_en')->nullable();
            $table->integer('min_ticket')->unsigned()->nullable();
            $table->integer('max_ticket')->unsigned()->nullable();
            $table->string('length_of_vacation',50)->nullable();
            $table->integer('status')->unsigned()->nullable();
            $table->string('slug')->nullable();
            $table->string('tag')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('created_by')->nullable();

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
        Schema::dropIfExists('packets');
    }
};
