<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataKasus extends Model
{
    //
    protected $table = "tbl_kasus";
 
    protected $fillable = [
        
        'nama',
        'np',
        // 'kode_direktorat',
        'nama_direktorat',
        // 'kode_unit',
        'nama_unit',
        // 'kode_divisi',
        'nama_divisi',
        'wilayah_kerja',
        'gedung',
        'lantai',
        'tempat_isolasi',
        'tempat_perawatan',
        'kluster_penyebaran',
        'status_vaksin',
        'tgl_positif',
        'tgl_negatif',
        'status',
        'kondisi'
        

    ];
}
