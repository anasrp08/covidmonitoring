<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDataKaryawan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_data_karyawan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('np');
            $table->string('pers_no');
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->string('tgl_lahir');
            $table->string('tgl_masuk');
            $table->string('kode_unit');
            $table->string('obj_id_unit');
            $table->string('nama_unit_s');
            $table->string('nama_unit_l');
            $table->string('jk');
            $table->string('agama');
            $table->string('kontrak');
            $table->string('grade');
            $table->string('ps_group');
            $table->string('ps_level');
            $table->string('kode_jab');
            $table->string('obj_id_jab');
            $table->string('nama_jab_s');
            $table->string('nama_jab_l');
            $table->string('dws');
            $table->string('dws_peruri');
            $table->string('tgl_dws_in');
            $table->string('start_time');
            $table->string('dws_out');
            $table->string('end_time');
            $table->string('start_break_time');
            $table->string('end_break_time');
            $table->string('lokasi');
            $table->string('actiontype');
            $table->string('tms');
            $table->string('kerja_tahun');
            $table->string('kerja_bulan');
            $table->string('kerja_hari');
            $table->string('mpp');
            $table->string('pensiun');
            

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
        Schema::dropIfExists('tbl_data_karyawan');
    }
}
