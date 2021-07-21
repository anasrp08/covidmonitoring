<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDetailKasus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_detail_kasus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_kasus')->unsigned()->nullable();
            $table->foreign('id_kasus')->references('id')->on('tbl_header_kasus')->onDelete('cascade');
            $table->string('np');
            $table->string('nama')->nullable();
            $table->string('direktorat')->nullable();
            $table->string('divisi')->nullable();
            $table->string('unit')->nullable();
            $table->string('wilayah_kerja')->nullable();
            $table->date('tgl')->nullable();
            $table->string('tipe_tes')->nullable();
            $table->string('kondisi')->nullable();
            $table->string('gedung')->nullable();
            $table->string('lantai')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('tempat_perawatan')->nullable();
            $table->string('kluster_penyebaran')->nullable();
            $table->string('status')->nullable();
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
        Schema::disableForeignKeyConstraints();
        // Schema::table('tr_headermutasi', function (Blueprint $table) {
        //     $table->dropForeign(['idlimbah']);
        //     $table->dropForeign(['idjenislimbah']);
        //     $table->dropForeign(['idtps']);
        //     $table->dropForeign(['idvendor']);
        //     $table->dropColumn(['idlimbah','idjenislimbah','idtps','idvendor']);
        // });
        Schema::dropIfExists('tbl_detail_kasus');
        Schema::enableForeignKeyConstraints(); 
    }
}
