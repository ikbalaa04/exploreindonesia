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
        Schema::create('partners', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('zone_id',36)->nullable();
            $table->foreign('zone_id')->references('id')->on('zones');
            
            $table->string('name',100)->nullable();
            $table->text('file')->nullable();
            $table->text('background')->nullable();
            $table->string('pic',100)->nullable();
            $table->string('mobile_phone',100)->nullable();
            $table->string('email',254)->nullable();
            $table->text('address')->nullable();
            $table->text('about')->nullable();
            $table->string('account_chat',254)->nullable();
            $table->string('website',254)->nullable();
            $table->string('region',100)->nullable();
            $table->integer('position')->nullable();
            $table->integer('status')->default(1);
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('partners');
    }
};
