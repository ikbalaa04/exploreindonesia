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
        Schema::create('packet_rating_review_files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('packet_rating_review_id',36)->nullable();
            $table->foreign('packet_rating_review_id')->references('id')->on('packet_rating_reviews');
            $table->string('name', 100)->nullable();
            $table->text('file')->nullable();
            
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
        Schema::dropIfExists('packet_rating_review_files');
    }
};
