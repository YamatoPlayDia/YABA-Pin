<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('writer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('reader_id')->constrained('users')->onDelete('cascade');
            $table->text('himitsu');
            $table->foreignId('spot_id')->constrained('spots')->onDelete('cascade');
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
}

