<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanHasilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_hasils', function (Blueprint $table) {
            $table->id('id_laphasil');
            $table->foreignId('id_proposal');
            $table->string('judul_pkm');
            $table->foreignId('id_bidang');
            $table->foreignId('id_skim');
            $table->foreignId('id_semhas')->nullable();
            $table->string('lok_kegiatan');
            $table->integer('thn_usulan');
            $table->integer('thn_kegiatan');
            $table->integer('thn_pelaksanaan');
            $table->double('dana_dikti')->nullable();
            $table->double('dana_unla')->nullable();
            $table->double('dana_lainnya')->nullable();
            $table->string('nosk_pkm');
            $table->date('tglsk_pkm');
            $table->string('mitra_pkm');
            $table->string('dok_link');
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
        Schema::dropIfExists('laporan_hasils');
    }
}
