<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMdSto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_md_sto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_direktorat');
$table->string('abbr_direktorat');
$table->string('direktorat');
$table->string('id_divisi');
$table->string('abbr_divisi');
$table->string('divisi');
$table->string('id_departemen');
$table->string('abbr_departemen');
$table->string('departemen');
$table->string('id_seksi');
$table->string('abbr_seksi');
$table->string('seksi');
$table->string('id unit');
$table->string('abbr_unit');
$table->string('unit');
$table->string('id_unit_kerja');
$table->string('abbr_unit_kerja');
$table->string('unit_kerja');
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
        Schema::dropIfExists('tbl_md_sto');
    }
}
