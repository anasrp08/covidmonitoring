<?php

namespace App\Imports;

use App\DataKasus;
use App\DataKasusNew;
use App\PerformanceLevel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\Importable; 
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class FirstSheetImport implements ToModel, WithStartRow ,WithCalculatedFormulas
{
    /**
    * @param array $array
    */
    use Importable;
    public function model(array $row)
    {
        return new DataKasusNew([
            'nama' => $row[1], 
            'np' => $row[2], 
            'gedung'=> $row[3],
            'lantai'=> $row[4],
            'kota'=> $row[5],
            'tempat_perawatan'=> $row[6],
            'kluster_penyebaran'=> $row[7],
            'status_vaksin'=> $row[8],
            'tgl_positif'=> \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9]),
            'status'=> $row[10],
            'kondisi'=> $row[11],
            'tgl_negatif'=> '',
            
        ]);
    }
    public function startRow(): int
    {
        return 2;
    }
     
}
