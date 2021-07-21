<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_prov', function (Blueprint $table) {
            $table->bigIncrements('id');
          
            // $table->integer('id_transaksi');
            $table->string('provinsi');
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
        Schema::disableForeignKeyConstraints();
        // Schema::table('tr_headermutasi', function (Blueprint $table) {
        //     $table->dropForeign(['idlimbah']);
        //     $table->dropForeign(['idjenislimbah']);
        //     $table->dropForeign(['idtps']);
        //     $table->dropForeign(['idvendor']);
        //     $table->dropColumn(['idlimbah','idjenislimbah','idtps','idvendor']);
        // });
        Schema::dropIfExists('tbl_prov');
        Schema::enableForeignKeyConstraints();
    }
}
