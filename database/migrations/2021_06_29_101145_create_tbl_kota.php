<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblKota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_kota', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_prov')->unsigned()->nullable();
            $table->foreign('id_prov')->references('id')->on('tbl_prov')->onDelete('cascade');
            $table->string('kota');
            $table->string('keterangan');
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
        // Schema::dropIfExists('tbl_kota');
        Schema::disableForeignKeyConstraints();
        // Schema::table('tr_headermutasi', function (Blueprint $table) {
        //     $table->dropForeign(['idlimbah']);
        //     $table->dropForeign(['idjenislimbah']);
        //     $table->dropForeign(['idtps']);
        //     $table->dropForeign(['idvendor']);
        //     $table->dropColumn(['idlimbah','idjenislimbah','idtps','idvendor']);
        // });
        Schema::dropIfExists('tbl_kota');
        Schema::enableForeignKeyConstraints();
    }
}
