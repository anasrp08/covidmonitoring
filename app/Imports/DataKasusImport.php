<?php

namespace App\Imports;

use App\DataKasus;
use App\PerformanceLevel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DataKasusImport implements ToModel, WithStartRow
{
    /**
    * @param array $array
    */
    public function model(array $row)
    {
        
        return new DataKasus([
            'nama' => $row[1],
            'np' => $row[2],
            'nama_direktorat'=> $row[3],
        // 'kode_unit',
        'nama_unit'=> $row[4],
        // 'kode_divisi',
        'nama_divisi'=> $row[5],
            'wilayah_kerja' => $row[6],
            'gedung' => $row[7],
            'lantai' => $row[8],
            'tempat_isolasi' => $row[9],
            'tempat_perawatan' => $row[10],
            'kluster_penyebaran' => $row[11],
            'status_vaksin' => $row[12],
            'tgl_positif' =>\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[13]),
            'tgl_negatif' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[14]),
            'status' => $row[15],
            'kondisi' => $row[16],
             

        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
}
