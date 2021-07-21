<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblKasus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kasus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
$table->string('np');
$table->string('kode_direktorat');
$table->string('nama_direktorat'); 
$table->string('kode_unit');
$table->string('nama_unit');
$table->string('kode_divisi');
$table->string('nama_divisi');
$table->string('wilayah_kerja');
$table->string('gedung');
$table->string('lantai');
$table->string('tempat_isolasi');
$table->string('tempat_perawatan');
$table->string('kluster_penyebaran');
$table->string('status_vaksin');
$table->date('tgl_positif');
$table->date('tgl_negatif');
$table->string('status');
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
        Schema::dropIfExists('tbl_kasus');
    }
}
