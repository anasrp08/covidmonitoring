@extends('layouts.app')
@section('title')
<title>Input Form</title>
{{-- <h4 class="navbar-brand" href="javascript:;">Dashboard</h4> --}}
@endsection
@section('header')
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-12 mt-4 card card-waves h-100">
                    <div class="card-body px-5 pt-2 pb-0">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-lg-8">
                                <h1 class="text-primary">Input Data Pasien Covid Peruri</h1>
                                <p class="text-primary lead mb-4">Input By Form untuk mengisi data melalui form yang
                                    tersedia</p>
                                <p class="text-primary lead mb-4">Input By Upload untuk mengisi data melalui upload file
                                    excel</p>

                            </div>
                            <div class="col-lg-3"><img class="img-fluid"
                                    src="{{ asset('/sb-admin-pro/dist/assets/img/freepik/problem-solving-pana.svg')}}" />
                            </div>
                        </div>
                        <nav class="nav nav-borders">
                            <a class="nav-link active ml-0" href="{{route('data.input')}}">Input By Form</a>
                            <a class="nav-link" href="{{route('data.input_upload')}}">Input By Upload Excel</a>

                        </nav>
                    </div>
                </div>
            </div>


        </div>
    </div>
</header>
@endsection
@section('content')
<div class="row">

    @include('input_data.f_form')
</div>
<div class="row">

    @include('input_data.tbl_form')
</div>

@endsection
@section('scripts')

<script>
    //tinggal select hapus sama simpan data
    var counter = 1;
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

    function selectbs4() {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    }
    $('#tgl').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd/mm/yyyy',
        todayHighlight: true
    });
    $('#np').on('change', function () {
        // console.log($(this).val())
        getKaryawan($(this).val())
    })
    $('#provinsi').on('change', function () { 
        getKota('{{route('data.kota')}}', $(this).val(), 'isolasi')
    })

    function getKota(paramUrl, param1, comp) {

        var paramData

        // console.log(param1)
        paramData = {
            id_prov: param1,
            // fisik: param2
        }
        $.ajax({
            url: paramUrl,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: paramData,
            success: function (data) {
                // if(data==''){

                // }
                $("#" + comp).html(data.html);
            }
        });

    }

    function getKaryawan(np) {
        var paramData = {
            np: np
        }
        $.ajax({
            url: "{{route('data.karyawan')}}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: paramData,
            // contentType: false,
            // // cache: false,
            // processData: false,
            // dataType: "json",
            beforeSend: function () {
                $('#simpan').text('proses menyimpan...');
            },
            
            success: function (data) {
                console.log(data)
                if(data.data==null){
                    Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: $('#np').val()+' Tidak terdaftar ESS, Isi Manual Nama, Nama Divisi, Unit & Direktorat',
                showConfirmButton: true,
                // timer: 1500
            })
                }else{
                    var dataKaryawan = data.data 
                $('#nama').val(dataKaryawan.nama);
                $('#unit').val(dataKaryawan.unit_kerja);
                $('#divisi').val(dataKaryawan.divisi);
                $('#direktorat').val(dataKaryawan.direktorat);
                $('#wilayah_kerja').val(dataKaryawan.lokasi).change()
                }
              
            }
        })
    }



    var ajaxParam
    var columnData
    var table = dataTables.form('#tbl_form', ajaxParam, columnData)

    function assignToTable(collectid, counter) {

        var valWarna;

        var getValueInput = [
            $("#tgl").val(),
            $('#np').val(),
            $('#nama').val(),
            $('#unit').val(),
            $('#divisi').val(),
            $('#direktorat').val(),
            

        ]


        var getSelected = [
            $('#wilayah_kerja').val(),
            $('#gedung').val(),
            $('#lantai').val(),
            $('#provinsi').val(),
            $('#isolasi').val(),
            $('#perawatan').val(),
            $('#klaster').val(),
            $('#vaksin').val(),
            $('#status').val(),
            $('#kondisi_kasus').val(),

            // $('#kondisi').val(),

        ]



        for (i = 0; i < collectid[0].length; i++) {

            $("#id" + collectid[0][i] + counter).val(getValueInput[i])

        }
        // console.log(getSelected)
        for (j = 0; j < collectid[1].length; j++) {
            // console.log('id' + collectid[1][j]+ counter )
            $('select[id=' + collectid[1][j] + counter + ']').find('option[value="' + getSelected[j] + '"]')
                .attr("selected", true).change();
            // document.getElementById("id" + collectid[1][j] + counter).selectedIndex = getSelected[j];
        }
        // selectbs4()
    }


    function createInputTextEnabled(id, counter, data) {
        return '<input style="width:auto;"type="text" name="' + id + '"  id="id' + id + counter +
            '" class="form-control" value="' + data + '" >'
    }
    function createInputTextDisabled(id, counter, data) {
        return '<input style="width:auto;"type="text" name="' + id + '"  id="id' + id + counter +
            '" class="form-control" value="' + data + '" disabled>'
    }


    function createDropdown(id, counter, option) {
        // selectbs4()
        return '<select name="' + id + '" id="' + id + counter +
            '" class="form-control select2bs4" style="width: auto;">' +
            option + '</select>'


    }
    function createDropdownTnpaSearch(id, counter, option) {
        // selectbs4()
        return '<select name="' + id + '" id="' + id + counter +
            '" class="form-control" style="width: auto;">' +
            option + '</select>'


    }

    function validation() {
        if ($("#np").val() != '') {
            if ($("#wilayah_kerja").val() != null) {
                if ($("#gedung").val() != null) {
                    if ($("#lantai").val() != null) {
                        if ($("#klaster").val() != null) {
                            if ($("#isolasi").val() != null) {
                                if ($("#perawatan").val() != null) {
                                    if ($("#kondisi_kasus").val() != null) {
                                        if ($("#tgl").val() != null) {
                                            if ($("#status").val() != null) {
                                                if ($("#vaksin").val() != null) {
                                                    return true;

                                                } else {
                                                    return 'Status Vaksin harus diisi';
                                                }
                                                return true;

                                            } else {
                                                return 'Status Monitoring harus diisi';
                                            }

                                            return true;

                                        } else {
                                            return 'Tgl harus diisi';
                                        }
                                        return true;

                                    } else {
                                        return 'Kondisi Kasus harus diisi';
                                    }

                                } else {
                                    return 'Tempat Perawatan Asal';
                                }
                            } else {
                                return 'Tempat Isolasi harus diisi';
                            }
                        } else {
                            return 'klaster harus diisi';
                        }
                    } else {
                        return 'lantai harus diisi';
                    }
                } else {
                    return 'Gedung harus diisi';
                }
            } else {
                return 'wilayah harus diisi';
            }

        } else {
            return 'NP harus diisi';
        }
    }
    $('#copy').on('click', function () {
        console.log($("#isolasi").val())
        var isNotEmpty = validation()
        if (isNotEmpty == true) {

            collectid = [
                [
                    'tgl',
                    'np',
                    'nama',
                    'unit',
                    'divisi',
                    'direktorat',
                   


                ],
                [
                    'wilayah_kerja',
                    'gedung',
                    'lantai',
                    'provinsi',
                    'isolasi',
                    'perawatan',
                    'klaster',
                    'vaksin',
                    'status',
                    'kondisi_kasus',

                    // 'kondisi',
                ]

            ]

            table.row.add([
                //id table
                counter,

                createInputTextEnabled("tgl", counter, ""),
                createInputTextEnabled("np", counter, ""),
                createInputTextEnabled("nama", counter, ""),
                createInputTextEnabled("unit", counter, ""),
                createInputTextEnabled("divisi", counter, ""),
                createInputTextEnabled("direktorat", counter, ""),

                createDropdown("wilayah_kerja", counter,
                    '<option value="" disabled selected>-</option>' +
                    '@foreach($dataLokasikerja as $data)' +
                    '<option value="{{$data->lokasi}}">{{$data->lokasi}} </option>' +
                    '@endforeach'),
                createDropdown("gedung", counter,
                    '<option value="" disabled selected>-</option>' +
                    '<option value="" disabled selected>-</option>' +
                    '@foreach($dataGedung as $data)' +
                    '<option value="{{$data->gedung}}">{{$data->gedung}} </option>' +
                    '@endforeach'),
                createDropdown("lantai", counter,
                    '<option value="" disabled selected>-</option>' +
                    '<option value="1"  selected>1</option>'+
                                '<option value="2" >2</option>'+
                                '<option value="3" >3</option>'),
                                createDropdownTnpaSearch("provinsi", counter,
                    '<option value="" disabled selected>-</option>' +
                    '@foreach($dataProv as $data)' +
                    '<option value="{{$data->provinsi}}">{{$data->provinsi}} </option>' +
                    '@endforeach'),
                    createDropdownTnpaSearch("isolasi", counter,
                    '<option value="" disabled selected>-</option>' +
                    '@foreach($dataKota as $data)' +
                    '<option value="{{$data->kota}}">{{$data->kota}} </option>' +
                    '@endforeach'),
                    // createInputTextDisabled("isolasi", counter, ""),
                createDropdown("perawatan", counter,
                    '<option value="" disabled selected>-</option>' +
                    '@foreach($dataIsolasi as $data)' +
                    '<option value="{{$data->tempat}}">{{$data->tempat}} ({{$data->kota}}) </option>' +
                    '@endforeach'),
                createDropdown("klaster", counter,
                    '<option value="" disabled selected>-</option>' +
                    '@foreach($dataKlaster as $data)' +
                    '<option value="{{$data->klaster}}">{{$data->klaster}} </option>' +
                    '@endforeach'),
                createDropdown("vaksin", counter,
                    '<option value="" disabled selected>-</option>' +
                    '@foreach($dataVaksin as $data)' +
                    '<option value="{{$data->status}}">{{$data->status}} </option>' +
                    '@endforeach'),
                createDropdown("status", counter,
                    '<option value="" disabled selected>-</option>' +
                    '@foreach($dataStatus as $data)' +
                    '<option value="{{$data->status}}">{{$data->status}} </option>' +
                    '@endforeach'),
                createDropdown("kondisi_kasus", counter,
                    '<option value="" disabled selected>-</option>' +
                    '@foreach($dataKondisi as $data)' +
                    '<option value="{{$data->status}}">{{$data->status}} </option>' +
                    '@endforeach'),



            ]).draw(false);

            assignToTable(collectid, counter);
            counter++;
            selectbs4()
        } else {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Ada '+isNotEmpty+' Inputan Yang Belum Terisi',
                showConfirmButton: true,
                // timer: 1500
            })
            // toastr.error('Field ' + isNotEmpty + ' Belum Terisi', 'Field Kosong', {
            //     timeOut: 5000
            // });

        }

    });

    function sendData() {
        var myTable = $("#tbl_form").DataTable();
        var form_data = myTable.rows().data();
        console.log(form_data)
        if (table.rows().count() == 0) {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Tidak ada inputan data, silahkan masukkan data',
                showConfirmButton: false,
                timer: 1500
            })

        } else {

            var output = [];
            var jsonData = {}

            $("tbody tr").each(function () {
                // if ($(":input[name=nama_limbah]", this).val() == "") {
                //     toastr.warning('Ada Data Yang Belum Diisi', 'Data Kosong', {
                //         timeOut: 5000
                //     });
                // }
                if ($(":input[name=tgl]", this).val() == undefined) {
                    // console.log($(":input[name=tgl_positif]", this).val())
                } else {
                    var obj = {};
                    obj.tgl = $(":input[name=tgl]", this).val();
                    obj.np = $(":input[name=np]", this).val();
                    obj.nama = $(":input[name=nama]", this).val();
                    obj.nama_direktorat = $(":input[name=direktorat]", this).val();
                    obj.nama_divisi = $(":input[name=divisi]", this).val();
                    obj.nama_unit = $(":input[name=unit]", this).val();
                    obj.wilayah_kerja = $("select[name=wilayah_kerja]", this).val();
                    obj.gedung = $("select[name=gedung]", this).val();
                    obj.lantai = $("select[name=lantai]", this).val();
                    obj.kota = $(":input[name=isolasi]", this).val();
                    obj.provinsi = $(":input[name=provinsi]", this).val();
                    obj.tempat_perawatan = $("select[name=perawatan]", this).val();
                    obj.kluster_penyebaran = $("select[name=klaster]", this).val();
                    obj.status_vaksin = $("select[name=vaksin]", this).val();
                    obj.kondisi = $(":input[name=kondisi_kasus]", this).val();
                    obj.status = $(":input[name=status]", this).val();
                    // console.log(obj)
                    output.push(obj);
                }

            });
            jsonData["Data"] = output
            console.log(jsonData)
            $.ajax({
                url: "{{route('data.store')}}",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: JSON.stringify(jsonData),

                beforeSend: function () {
                    $('.simpan').text('proses menyimpan...');
                    $('.simpan').prop('disabled', true);
                },
                success: function (data) {

                    if (data.error) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: data.error,
                            showConfirmButton: true,
                            // timer: 1500
                        })
                    }
                    if (data.success) {

                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: data.success,
                            showConfirmButton: true,
                            // timer: 1500
                        })

                        setTimeout(function () {
                            // window.location.reload();

                        }, 4000);



                    }
                    $('.simpan').text('Simpan Data');
                    $('.simpan').prop('disabled', false);

                }
            })
        }
    }

</script>
@endsection
