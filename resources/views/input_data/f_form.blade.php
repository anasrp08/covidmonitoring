<div class="col-xxl-12 col-xl-12 mb-4">
    <div class="card h-100">
        <div class="card ">
            <div class="card-header">Daftar Pasien Covid Peruri</div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" class="form-control" id="hidden_id" name="hidden_id">

                        <label for="nama">1 Nama Pegawai</label>
                        <div class="input-group input-group-joined">
                            <div class="input-group-prepend col-md-3">
                                <input type="text" class="form-control" id="np" name="np"
                                placeholder="NP">
                                {{-- <select name="np" id="np" class="select2bs4" style="width: 100%;">
                                    <option value="" disabled selected>-</option>
                                    @foreach($dataKaryawan as $data)
                                    <option value="{{$data->np_karyawan}}">{{$data->np_karyawan}}  
                                    </option>
                                    @endforeach
                                </select> --}}
                            </div>

                            <input type="text" class="form-control" id="nama" name="nama"
                                placeholder="-" >
                        </div>
                    </div>
                    {{-- <label for="np">Nomor Pegawai</label> --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="unit">2. Nama Unit</label>
                            <input type="text" class="form-control" id="unit" name="unit"
                                placeholder="-" >
                        </div>
                    </div>




                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="wilayah_kerja">3. Wilayah kerja</label>
                            <select name="wilayah_kerja" id="wilayah_kerja" class="form-control select2bs4"
                                style="width: 100%;">
                                <option value="" disabled selected>-</option>
                                @foreach($dataLokasikerja as $data)
                                <option value="{{$data->lokasi}}">{{$data->lokasi}} </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="divisi">4. Nama Divisi</label>
                            <input type="text" class="form-control" id="divisi" name="divisi"
                                placeholder="-" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="direktorat">5. Nama Direktorat</label>
                            <input type="text" class="form-control" id="direktorat" name="direktorat"
                                placeholder="-" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gedung">6. Lokasi Gedung Kerja </label>
                            <select name="gedung" id="gedung" class="form-control select2bs4" 
                                style="width: 100%;">
                                <option value="" disabled selected>-</option>
                                @foreach($dataGedung as $data)
                                <option value="{{$data->gedung}}">{{$data->gedung}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lantai">7. Lantai Ruangan</label>
                            <select name="lantai" id="lantai" class="form-control select2bs4"
                                style="width: 100%;">
                                <option value="1"  selected>1</option>
                                <option value="2" >2</option>
                                <option value="3" >3</option>
                                <option value="Ground" >Ground</option>
                                <option value="Pos 1" >Pos 1</option>
                               
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="form-group">
                            <label for="klaster">8. Klaster Penyebaran</label>
                            <select name="klaster" id="klaster" class="form-control select2bs4"
                                style="width: 100%;">
                                <option value="" disabled selected>-</option>
                                @foreach($dataKlaster as $data)
                                <option value="{{$data->klaster}}">{{$data->klaster}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="provinsi">9. Provinsi</label>
                            <select name="provinsi" id="provinsi" class="form-control select2bs4"
                                style="width: 100%;">
                                <option value="" disabled selected>-</option>
                                @foreach($dataProv as $data)
                                <option value="{{$data->provinsi}}">{{$data->provinsi}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="isolasi">10. Kota</label>
                            <select name="isolasi" id="isolasi" class="form-control select2bs4"
                                style="width: 100%;">
                                <option value="" disabled selected>-</option>
                         
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="perawatan">11. Tempat Perawatan</label>
                            <select name="perawatan" id="perawatan" class="form-control select2bs4"
                                style="width: 100%;">
                                <option value="" disabled selected>-</option>
                                @foreach($dataIsolasi as $data)
                                <option value="{{$data->tempat}}">{{$data->tempat}} ({{$data->kota}}) </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                 
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kondisi_kasus">12. Kondisi Karyawan</label>
                            <select name="kondisi_kasus" id="kondisi_kasus" class="form-control select2bs4"
                                style="width: 100%;">
                                <option value="" disabled selected>-</option>
                                @foreach($dataKondisi as $data)
                                <option value="{{$data->status}}">{{$data->status}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">

                        <div class="form-group">
                            <label for="tgl">13. Tanggal</label>
                            <input type="text" class="tgl form-control" id="tgl"  name="tglpositif"
                                 >
                        </div>
                    </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="status">14. Status</label>
                                <select name="status" id="status" class="form-control select2bs4"
                                    style="width: 100%;">
                                    <option value="" disabled selected>-</option>
                                    @foreach($dataStatus as $data)
                                    <option value="{{$data->status}}">{{$data->status}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="vaksin">15. Status Vaksin</label>
                                <select name="vaksin" id="vaksin" class="form-control select2bs4"
                                    style="width: 100%;">
                                    <option value="" disabled selected>-</option>
                                    @foreach($dataVaksin as $data)
                                    <option value="{{$data->status}}">{{$data->status}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label for="kondisi">15. Kondisi</label>
                                <select name="kondisi" id="kondisi" class="form-control select2bs4"
                                    style="width: 100%;">
                                    <option value="" disabled selected>-</option>
                                    @foreach($dataVaksin as $data)
                                    <option value="{{$data->status}}">{{$data->status}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}

                   
                </div>
                
            </div>
            <div class="card-footer text-center">
               
                <button class="btn btn-success" type="button" id='copy'>Input</button>
             
            </div>


        </div>
    </div>
</div>
