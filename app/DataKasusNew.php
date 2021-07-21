<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataKasusNew extends Model
{
    //
    protected $table = "tbl_header_kasus";
 
    protected $fillable = [
        'nama',
        'np',
        'wilayah_kerja',
'gedung',
'lantai', 
'kota',
'tempat_perawatan',
'kluster_penyebaran',
'kondisi',
'status_vaksin',
'tgl_positif',
'tgl_negatif',
'status'
    ];
}
