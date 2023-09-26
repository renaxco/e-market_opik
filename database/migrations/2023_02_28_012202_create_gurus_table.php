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
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->string('nama',100);
            $table->string('nip', 20);
            $table->string('jenisKelamin', 1);
            $table->string('tempatLahir', 50)->nullable();
            $table->date('tanggalLahir')->nullable();
            $table->string('nik', 20)->nullable();
            $table->string('agama', 20)->nullable();
            $table->string('alamat', 20)->nullable();
            $table->integer('isActive')->default(DB::raw(1));
            $table->integer('isDeleted')->default(DB::raw(0));
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gurus');
    }
};
