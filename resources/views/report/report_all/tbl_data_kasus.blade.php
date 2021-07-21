<div class="col-xxl-12 col-xl-12 mb-4">
    <div class="card h-100">
        <div class="card ">
            <div class="card-header">Daftar Status Pasien</div>
          
            <div class="card-body ">
              
                <div class="datatable">
                    <div class="row">
                        <button href="" name="export" id='export'
                        class="edit btn btn-primary edit-user">
                        <i class="fas fa-download"></i> Download Excel
                    </button>
                    </div>
                    <table class="table table-stripped table-hover" id="tbl_kasus"  >
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NP</th>
                                <th>NAMA</th>  
                                <th>NAMA DIREKTORAT </th>
                                {{-- <th>KODE UNIT</th> --}}
                               
                                {{-- <th>KODE DIVISI</th> --}}
                                <th>NAMA DIVISI</th>
                                <th>NAMA UNIT</th>
                                <th>WILAYAH KERJA</th>

                                <th>GEDUNG</th>
                                <th>LANTAI</th>
                                {{-- <th>PROVINSI</th> --}}
                                <th>KOTA</th>
                                <th>TEMPAT PERAWATAN</th>
                                <th>KLUSTER PENYEBARAN</th>
                                <th>STATUS VAKSIN</th>
                                <th>KONDISI</th>
                                <th>TGL. POSITIF</th> 
                                <th>TGL. NEGATIF</th> 
                                <th>STATUS</th>
                                <th>TGL DIBUAT</th>
                                <th>TGL DIUPDATE</th>
                                {{-- <th>ACTION</th> --}}
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
