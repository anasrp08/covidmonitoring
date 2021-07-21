<div class="col-xxl-12 col-xl-12 mb-4">
    <div class="card h-100">
        <div class="card ">
            <div class="card-header">Filter Data Table</div>
            <div class="card-body ">
                <div class="row"> 

                        <div class="col-md-4">
                            <input type="hidden" class="form-control" id="hidden_id" name="hidden_id">
                            <div class="form-group">
                                <label for="np_edit">Nomor Pegawai</label>
                                <input type="text" class="form-control" id="np_edit" name='np_edit'>

                            </div>
                            <div class="form-group">
                                <label for="nama_edit">Nama Pegawai</label>
                                <input type="text" class="form-control" id="nama_edit" name='nama_edit'
                                    placeholder="Another input placeholder" disabled>
                                {{-- <select name="nama_edit" id="nama_edit" class="form-control select2bs4"
                            style="width: 100%;">
                            <option value="" disabled selected>-</option>
                            @foreach($dataKaryawan as $data)
                            <option value="{{$data->nama}}">{{$data->nama}} </option>
                                @endforeach
                                </select> --}}
                            </div>

                            <div class="form-group">
                                <label for="wilayah_kerja_edit">Wilayah kerja</label>
                                <select name="wilayah_kerja_edit" id="wilayah_kerja_edit"
                                    class="form-control select2bs4" style="width: 100%;">
                                    <option value="" disabled selected>-</option>
                                    @foreach($dataLokasikerja as $data)
                                    <option value="{{$data->lokasi}}">{{$data->lokasi}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="direktorat_edit">Nama Direktorat</label>
                                <input type="text" class="form-control" id="direktorat_edit" name="direktorat_edit"
                                    placeholder="Another input placeholder" disabled>
                            </div>
                            <div class="form-group">
                                <label for="divisi_edit">Nama Divisi</label>
                                <input type="text" class="form-control" id="divisi_edit" name="direktorat_edit"
                                    placeholder="Another input placeholder" disabled>
                            </div>



                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="klaster_edit">Klaster Penyebaran</label>
                                <select name="klaster_edit" id="klaster_edit" class="form-control select2bs4"
                                    style="width: 100%;">
                                    <option value="" disabled selected>-</option>
                                    @foreach($dataKlaster as $data)
                                    <option value="{{$data->klaster}}">{{$data->klaster}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gedung_edit">Lokasi Gedung Kerja </label>
                                <select name="gedung_edit" id="gedung_edit" class="form-control select2bs4"
                                    style="width: 100%;">
                                    <option value="" disabled selected>-</option>
                                    @foreach($dataLokasikerja as $data)
                                    <option value="{{$data->gedung}}">{{$data->gedung}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lantai_edit">Lantai Ruangan</label>
                                <select name="lantai_edit" id="lantai_edit" class="form-control select2bs4"
                                    style="width: 100%;">
                                    <option value="" disabled selected>-</option>
                                    @foreach($dataLokasikerja as $data)
                                    <option value="{{$data->gedung}}">{{$data->gedung}} ({{$data->lantai}}) </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="isolasi_edit">Tempat Isolasi</label>
                                <select name="isolasi_edit" id="isolasi_edit" class="form-control select2bs4"
                                    style="width: 100%;">
                                    <option value="" disabled selected>-</option>
                                    @foreach($dataIsolasi as $data)
                                    <option value="{{$data->kota}}">{{$data->kota}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="perawatan_edit">Tempat Perawatan</label>
                                <select name="perawatan_edit" id="perawatan_edit" class="form-control select2bs4"
                                    style="width: 100%;">
                                    <option value="" disabled selected>-</option>
                                    @foreach($dataIsolasi as $data)
                                    <option value="{{$data->tempat}}">{{$data->tempat}} ({{$data->kota}}) </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">

                            <div class="form-group">
                                <label for="tglpositif_edit">Tanggal Positif</label>
                                <input type="text" class="datepicker form-control" id="tglpositif_edit"
                                    name="tglpositif_edit">
                            </div>
                            <div class="form-group">
                                <label for="tglnegative_edit">Tanggal Negative</label>
                                <input type="text" class="datepicker form-control" id="tglnegative_edit"
                                    name="tglnegative_edit">
                            </div>

                            <div class="form-group">
                                <label for="status_edit">Status Monitoring</label>
                                <select name="status_edit" id="status_edit" class="form-control select2bs4"
                                    style="width: 100%;">
                                    <option value="" disabled selected>-</option>
                                    @foreach($dataStatus as $data)
                                    <option value="{{$data->status}}">{{$data->status}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="vaksin_edit">Status Vaksin</label>
                                <select name="vaksin_edit" id="vaksin_edit" class="form-control select2bs4"
                                    style="width: 100%;">
                                    <option value="" disabled selected>-</option>
                                    @foreach($dataVaksin as $data)
                                    <option value="{{$data->status}}">{{$data->status}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kondisi_kasus_edit">Kondisi Karyawan</label>
                                <select name="kondisi_kasus_edit" id="kondisi_kasus_edit"
                                    class="form-control select2bs4" style="width: 100%;">
                                    <option value="" disabled selected>-</option>
                                    @foreach($dataStatus as $data)
                                    <option value="{{$data->status}}">{{$data->status}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                         
                    </div> --}}
 
                   

                </div>
                <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label for="unit_edit">Nama Unit</label>
                          <input type="text" class="form-control" id="unit_edit"
                              placeholder="Another input placeholder" disabled>
                      </div>
                  </div>
              </div>
            </div>
            <div class="card-footer text-center">



                <button class="btn btn-success" type="button" id='filter'>Filter</button>
                <button class="btn btn-success" type="button" id='export'>Export</button>
            </div>

        </div>
    </div>
</div>
