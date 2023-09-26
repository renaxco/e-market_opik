<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePemasok extends Migration
{

    public function up()
    {
        Schema::create('pemasok', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_pemasok');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }
    public function down()
    {
        Schema::dropIfExists('pemasok');
    }
}
