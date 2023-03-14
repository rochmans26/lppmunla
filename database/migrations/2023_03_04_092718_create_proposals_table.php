<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id('id_proposal');
            $table->string('judul_proposal');
            $table->string('slug')->unique();
            $table->foreignId('id_bidang');
            $table->foreignId('id_skim');
            $table->string('lokasi_kegiatan');
            $table->integer('thn_usulan');
            $table->integer('thn_kegiatan');
            $table->integer('thn_pelaksanaan');
            $table->foreignId('id_sempro')->nullable();
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
        Schema::dropIfExists('proposals');
    }
}
