<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Filter Data</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>No. Tender</label>
                        <input type="text" name="notender" id="notender" class="form-control" placeholder="No. Tender">
                    </div>
                    <div class="form-group">
                        <label>No. SPPJ</label>
                        <input type="text" name="nosppj" id="nosppj" class="form-control" placeholder="No. SPPJ">
                    </div>
                    <div id="formnosurat" class="form-group">
                        <label for="nosurat">No. JSEA</label>
                        <input type="text" name="nojsea" id="nojsea" class="form-control" placeholder="No. JSEA">
                        {{-- <small class="text-danger">{{ $errors->nosurat->first() }}</small> --}}
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tgl. Tender Dibuat</label>
                        <input type="text" id="tender_date" name="tender_date" class="date form-control"
                            autocomplete="off">
                    </div>
                    
                    <div class="form-group">
                        <label>Tgl. Review</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                              </span>
                            </div>
                            <input type="text" class="form-control float-right" id="review_date" name="review_date">
                          </div>
                        {{-- <input type="text" id="review_date" name="review_date" class="date form-control"
                            autocomplete="off"> --}}
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control select2bs4" style="width: 100%;">
                            <option value="" disabled selected>-Pilih Status-</option>
                            @foreach($dataStatus as $data)
                          <option value="{{$data->id}}">{{$data->status}} </option>
                            @endforeach

                        </select>
                    </div>
                </div>
            </div>

                <div class="box-footer text-center">
                    {{-- <input type="submit" name="action_button" id="action_button" class="btn btn-primary" value="Cari" /> --}}
                    <button id="cari" type="submit" class="btn btn-primary" >Cari</button>
                    {{-- <button id="kirim" type="submit" class="btn btn-primary" >kirim</button> --}}
                </div>
            </div>
        </div>
    </div>
