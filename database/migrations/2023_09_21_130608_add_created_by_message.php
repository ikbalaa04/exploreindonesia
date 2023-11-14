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
        Schema::table('messages', function (Blueprint $table) {
            $table->char('list_message_id', 36)->nullable()->after('recipient_id');
            $table->string('reply_by', 100)->nullable()->after('read_on');
            $table->integer('first_chat')->nullable()->after('reply_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn('list_message_id');
            $table->dropColumn('reply_by');
            $table->dropColumn('first_chat');
        });
    }
};
