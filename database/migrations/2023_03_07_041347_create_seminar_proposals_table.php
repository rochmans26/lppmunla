<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeminarProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seminar_proposals', function (Blueprint $table) {
            $table->id('id_sempro');
            $table->foreignId('id_proposal');
            $table->date('tgl_seminar');
            $table->time('jam_seminar');
            $table->string('sifat_seminar');
            $table->string('tmpt_seminar')->nullable();
            $table->string('tautan')->nullable();
            $table->string('reviewer1')->nullable();
            $table->string('reviewer2')->nullable();
            $table->text('note_rev1')->nullable();
            $table->text('note_rev2')->nullable();
            $table->string('dok_rev')->nullable();
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
        Schema::dropIfExists('seminar_proposals');
    }
}
