<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeminarHasilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seminar_hasils', function (Blueprint $table) {
            $table->id('id_semhas');
            $table->foreignId('id_laphasil');
            $table->date('tgl_semhas');
            $table->time('jam_semhas');
            $table->string('sifat_semhas');
            $table->string('tmpt_semhas')->nullable();
            $table->string('tautan_semhas')->nullable();
            $table->string('rev1_semhas')->nullable();
            $table->string('rev2_semhas')->nullable();
            $table->text('nrev1_semhas')->nullable();
            $table->text('nrev2_semhas')->nullable();
            $table->string('dok_rev_semhas')->nullable();
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
        Schema::dropIfExists('seminar_hasils');
    }
}
