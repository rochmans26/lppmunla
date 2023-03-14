<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaDosenLuarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota_dosen_luars', function (Blueprint $table) {
            $table->id();
            $table->string('nidn')->unique();
            $table->string('nm_dosen');
            $table->string('telp');
            $table->string('email');
            $table->string('fakultas');
            $table->string('prodi');
            $table->string('universitas');
            $table->string('peran');
            $table->foreignId('id_proposal');
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
        Schema::dropIfExists('anggota_dosen_luars');
    }
}
