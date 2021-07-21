<?php

namespace App\Exports;

use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Facades\Crypt;

class NilaiExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;
    public function __construct(
        string $id_process,
        string $pl,
        string $aktif,
        string $id_sto
    ) {
        $decryptIdProcess = $this->decrypted($id_process);
        $decryptIdSto = $this->decrypted($id_sto);

        $this->id_process = $decryptIdProcess;
        $this->id_sto = $decryptIdSto;
        $this->pl = $pl;
        $this->aktif = $aktif;
    }
    public function decrypted($data)
    {
        return Crypt::decrypt($data);
    }
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
        ini_set('max_execution_time', 360);
        ini_set('max_input_time', 120);


         $queryData = DB::table('tb_bonus_divisi')
                ->join('tb_sto', 'tb_bonus_divisi.id_sto', '=', 'tb_sto.id_sto')
                ->select(

                    'tb_bonus_divisi.np',
                    'tb_bonus_divisi.nama',
                    'tb_bonus_divisi.bonus',

                )
                ->where('tb_bonus_divisi.id_process', $this->id_process)
                ->where('tb_bonus_divisi.id_sto', $this->id_sto)
                ->where('tb_bonus_divisi.pl', $this->pl)
                ->where('tb_bonus_divisi.aktif', $this->aktif)
                ->orderBy('tb_bonus_divisi.rank', 'asc');
            $queryData = $queryData->get(); 
        return  $queryData;
    }
    public function headings(): array
    {
        return [
            "No Pokok",
            "Nama",
            "Bonus",
            "Apresiasi"
        ];
    }
    
}
