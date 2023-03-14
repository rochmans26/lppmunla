<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublikasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publikasis', function (Blueprint $table) {
            $table->id('id_publikasi');
            $table->foreignId('id_laphasil');
            $table->string('judul_jurnal');
            $table->string('nm_jurnal');
            $table->string('vol_jurnal');
            $table->string('no_jurnal');
            $table->date('tgl_terbit_jurnal');
            $table->integer('jumlah_penulis');
            $table->string('link_jurnal');
            $table->string('status_jurnal');
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
        Schema::dropIfExists('publikasis');
    }
}
