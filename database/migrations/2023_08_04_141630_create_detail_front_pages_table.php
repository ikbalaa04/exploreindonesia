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
        Schema::create('detail_front_pages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('white_label', 100);
            $table->string('title', 100)->nullable();
            $table->string('sub_title', 254)->nullable();
            $table->text('description')->nullable();
            $table->text('file')->nullable();
            $table->longText('ecotourism_guide')->nullable();
            $table->string('cta_name', 100)->nullable();
            $table->text('cta_url')->nullable();
            $table->string('created_by', 150)->nullable();
            $table->string('updated_by', 150)->nullable();
            
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
        Schema::dropIfExists('detail_front_pages');
    }
};
