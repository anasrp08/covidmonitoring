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
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
class DataKasusImportNew implements WithMultipleSheets
{
    /**
    * @param array $array
    */
    use Importable;
    // public function model(array $row)
    // {
    //     return new DataKasusNew([
    //         'np' => $row[1], 
    //         'gedung'=> $row[2],
    //         'lantai'=> $row[3],
    //         'kota'=> $row[4],
    //         'tempat_perawatan'=> $row[5],
    //         'kluster_penyebaran'=> $row[6],
    //         'status_vaksin'=> $row[7],
    //         'tgl_positif'=> $row[8],
    //         'status'=> $row[9],
    //         'kondisi'=> $row[10],
    //         'tgl_negatif'=> '',
            
    //     ]);
    // }
    public function startRow(): int
    {
        return 2;
    }
    public function sheets(): array
    {
        return [
            0 => new FirstSheetImport()
        ];
    }
}
