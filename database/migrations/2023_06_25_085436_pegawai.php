<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pegawai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pegawai', function (Blueprint $bp) {
            $bp->id();
            $bp->string('nama_lengkap', '80')->nullable(false);
            $bp->string('nip', 10)->nullable(false);
            $bp->string('jabatan', '80')->nullable(false);
            $bp->string('email', '128')->nullable(false);
            $bp->string('password', '64')->nullable(false);
            $bp->string('token', '128')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pegawai');
    }
}