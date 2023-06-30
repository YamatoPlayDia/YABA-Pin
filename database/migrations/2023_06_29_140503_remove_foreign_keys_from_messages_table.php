<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign('messages_reader_id_foreign'); // replace with the correct foreign key constraint name
            $table->dropForeign('messages_spot_id_foreign'); // replace with the correct foreign key constraint name
            $table->dropColumn(['reader_id', 'spot_id']);
        });
    }

    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->foreignId('reader_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('spot_id')->constrained('spots')->onDelete('cascade');
        });
    }

};
