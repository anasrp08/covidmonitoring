<?php
namespace App\Exports;
use DB;
use App\Jadwal; 
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;

 
class ReportExport implements FromCollection,WithColumnFormatting, WithHeadings
{
    public function __construct(string $tahun,
    string $status,
    string $jenispikai,
    string $tipepikai,
    string $seripikai)
    {
        $this->status = $status;
        $this->tahun = $tahun;
        $this->jenispikai = $jenispikai;
        $this->tipepikai = $tipepikai;
        $this->seripikai = $seripikai;
    }
// ​
use Exportable;
public function forYear(int $year)
{
    $this->year = $year;
    
    return $this;
}
public function forStatus(string $status)
{
    $this->status = $status;
    
    return $this;
}
    public function collection()
    {
        ini_set('memory_limit', '2048M');
        ini_set('max_execution_time', 240);
        ini_set('max_execution_time',360);
        ini_set('max_input_time', 120);


        $queryData=DB::table('tbl_header_kasus')
        ->leftjoin('tbl_data_karyawan','tbl_header_kasus.np','tbl_data_karyawan.np')
        ->select(
        'tbl_header_kasus.id',
        'tbl_header_kasus.nama',
        'tbl_header_kasus.np',
        'tbl_header_kasus.direktorat',
        'tbl_header_kasus.divisi',
        'tbl_header_kasus.unit',
       
        'tbl_data_karyawan.lokasi',
        'tbl_header_kasus.gedung',
        'tbl_header_kasus.lantai',
    'tbl_header_kasus.kota',
    
    'tbl_header_kasus.tempat_perawatan',
    'tbl_header_kasus.kluster_penyebaran',
    'tbl_header_kasus.status_vaksin',
    DB::raw('DATE_FORMAT(tbl_header_kasus.tgl_positif, "%d/%m/%Y") as tgl_positif'),
    DB::raw('DATE_FORMAT(tbl_header_kasus.tgl_negatif, "%d/%m/%Y") as tgl_negatif'),
    // 'tgl_positif',
    // 'tgl_negatif',
    'status',
    'kondisi',
    DB::raw('DATE_FORMAT(tbl_header_kasus.created_at, "%d/%m/%Y %H:%i:%S") as created_at'),
    DB::raw('DATE_FORMAT(tbl_header_kasus.updated_at, "%d/%m/%Y %H:%i:%S") as updated_at'),
    'tbl_header_kasus.provinsi',
    // 'created_at','updated_at'
   
    )->orderBy('tbl_header_kasus.id','asc');

        
            $queryData=$queryData->get();
           
           
        
         

        // return User::query()->where('name', 'like', '%'. $this->name);
        return  $queryData;
    }

    public function headings(): array
    {
        return [
            "No",
            "Nama",
            "NP",
            "Direktorat",
            "Divisi",
            "Unit Kerja",
            "Wilayah Kerja",
            "Gedung Kerja",
            "Lantai Kerja",
            "Tempat Isolasi (Kota)", 
            "Tempat Perawatan",
            "Klaster Penyebaran",
            "Status Vaksin",
            "Tanggal Positif",
            "Tanggal Negatif",
            "Status",
            "Kondisi",
            "Tgl. Dibuat",
            "Tgl. Diupdate",
            "Provinsi",
             
            
        ];
    }
    public function columnFormats(): array
    {
        return [
            'O' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'P' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'S' => NumberFormat::FORMAT_DATE_DATETIME,
            'T' => NumberFormat::FORMAT_DATE_DATETIME,
            // 'AJ' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'AL' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'AN' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            // 'N' => NumberFormat::FORMAT_NUMBER,
            // 'L' => NumberFormat::FORMAT_NUMBER,
            // 'V' => NumberFormat::FORMAT_NUMBER,
        ];
    }
    // public function map($row): array
    // {
    //     return [
    //         // $row->created_at->format('d/m/Y'),
    //         Date::dateTimeToExcel(Carbon::parse($row->tglsuratkantor)->format('Y-m-d'));
    //         // Date::dateTimeToExcel($row->created_at),
    //     ];
    // }
}
 
 