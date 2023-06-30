<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('messages', function (Blueprint $table) {
        $table->foreignId('reader_id')->nullable()->constrained('users')->onDelete('cascade')->default(null);
        $table->foreignId('spot_id')->nullable()->constrained('spots')->onDelete('cascade')->default(null);
        $table->string('status')->default('投下済み')->change();
    });
}

public function down()
{
    Schema::table('messages', function (Blueprint $table) {
        $table->foreignId('reader_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('spot_id')->constrained('spots')->onDelete('cascade');
        $table->string('status')->default('')->change();
    });
}

};
