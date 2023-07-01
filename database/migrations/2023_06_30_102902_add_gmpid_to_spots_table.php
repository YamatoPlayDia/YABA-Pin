<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGmpidToSpotsTable extends Migration
{
    public function up()
    {
        Schema::table('spots', function (Blueprint $table) {
            $table->string('gmpid')->nullable(); // 新たな列を追加
        });
    }

    public function down()
    {
        Schema::table('spots', function (Blueprint $table) {
            $table->dropColumn('gmpid'); // 列を削除
        });
    }
}
