<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFootprintsTable extends Migration
{
    public function up()
    {
        Schema::create('footprints', function (Blueprint $table) {
            $table->foreignId('id')->constrained('users')->onDelete('cascade');
            $table->unsignedInteger('rights_write');
            $table->unsignedInteger('rights_read');
            $table->decimal('lastlogin_latitude', 8, 6)->nullable();
            $table->decimal('lastlogin_longitude', 9, 6)->nullable();
            $table->decimal('latest_latitude', 8, 6)->nullable();
            $table->decimal('latest_longitude', 9, 6)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('footprints');
    }
}
