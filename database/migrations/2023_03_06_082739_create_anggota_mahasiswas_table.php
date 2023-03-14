<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_proposal');
            $table->string('npm')->unique();
            $table->string('nm_mahasiswa');
            $table->integer('id_prodi');
            $table->integer('thn_masuk');
            $table->string('peran');
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
        Schema::dropIfExists('anggota_mahasiswas');
    }
}
