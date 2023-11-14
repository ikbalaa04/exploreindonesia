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
        Schema::create('company_members', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('about_us_id',36)->nullable();
            $table->foreign('about_us_id')->references('id')->on('about_us');
            
            $table->string('first_name', 150);
            $table->string('last_name', 150);
            $table->string('title', 150);
            $table->text('file')->nullable();
            $table->string('email', 150);
            $table->string('mobile_phone', 150);
            $table->text('address')->nullable();
            $table->text('message')->nullable();

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
        Schema::dropIfExists('company_members');
    }
};
