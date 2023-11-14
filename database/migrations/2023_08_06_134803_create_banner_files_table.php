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
        Schema::create('banner_files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('banner_id',36)->nullable();
            $table->foreign('banner_id')->references('id')->on('banners');
            $table->text('file_name')->nullable();
            $table->string('type',10)->nullable();
            $table->string('cta_name', 50)->nullable();
            $table->text('cta_url')->nullable();
            $table->string('title', 50)->nullable();
            $table->string('subtitle', 150)->nullable();
            $table->text('description')->nullable();
            
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
        Schema::dropIfExists('banner_files');
    }
};
