<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrEvaluasiJsea extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tr_evaluasi_jsea', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->text('id_tender')->nullable();
            $table->bigInteger('id_daftar')->unsigned()->nullable();
            $table->foreign('id_daftar')->references('id')->on('tr_daftar_jsea')->onDelete('cascade');
            $table->text('catatan')->nullable();
            $table->string('kriteria')->nullable();
            $table->string('status')->nullable();
            $table->string('created_by')->nullable(); 
            $table->string('np')->nullable(); 
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
        Schema::dropIfExists('tr_evaluasi_jsea');
    }
}
