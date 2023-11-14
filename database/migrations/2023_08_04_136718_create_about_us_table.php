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
        Schema::create('about_us', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // $table->unsignedInteger('office_hours_id')->nullable();
            // $table->foreign('office_hours_id')->references('id')->on('office_hours');

            // $table->unsignedInteger('company_members_id')->nullable();
            // $table->foreign('company_members_id')->references('id')->on('company_members');

            // $table->unsignedInteger('achievement_id')->nullable();
            // $table->foreign('achievement_id')->references('id')->on('achievements');
            
            $table->string('name',100)->nullable();
            $table->string('nation',100)->nullable();
            $table->string('email',200)->nullable();
            $table->string('mobile_phone',50)->nullable();
            $table->string('whatsapp',50)->nullable();
            $table->string('twitter', 100)->nullable();
            $table->string('facebook', 100)->nullable();
            $table->string('instagram', 100)->nullable();
            $table->string('youtube', 100)->nullable();
            $table->string('linkedln', 100)->nullable();
            $table->text('address')->nullable();
            $table->string('latitude',100)->nullable();
            $table->string('longitude',100)->nullable();
            $table->text('iframe_google_maps')->nullable();
            $table->string('website',254)->nullable();
            $table->string('playstore',254)->nullable();
            $table->string('appstore',254)->nullable();
            $table->text('file')->nullable();
            $table->text('title_idn')->nullable();
            $table->text('title_en')->nullable();
            $table->text('short_description_idn')->nullable();
            $table->text('short_description_en')->nullable();
            $table->longText('description_idn')->nullable();
            $table->longText('description_en')->nullable();
            $table->string('since',20)->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_white')->nullable();
            $table->string('favicon')->nullable();
            $table->string('favicon_white')->nullable();
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
        Schema::dropIfExists('about_us');
    }
};
