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
            <div class="col-auto mt-4">
                <h1 class="page-header-title">
                    <div class="page-header-icon"><i data-feather="activity"></i></div>
                    Update Data Pasien
                </h1>
                {{-- <div class="page-header-subtitle">Summary Dashboard Covid Case Peruri</div> --}}
                <div class="page-header-subtitle" id='tanggal'>
                    <span class="font-weight-900 text-warning" id='day'></span>
                    {{-- &middot; September 20, 2020 &middot; 12:16 PM --}}
                </div>
            </div>
            <div class="col-12 col-xl-auto mt-4">
                {{-- <button class="btn btn-white btn-sm line-height-normal p-3" id="reportrange">
                    <i class="mr-2 text-primary" data-feather="calendar"></i>
                    <span></span>
                    <i class="ml-1" data-feather="chevron-down"></i>
                </button> --}}
            </div>
        </div>
    </div>
</div>
</header>
@endsection
@section('content')
<div class="row">
    <div class="col-xxl-12 col-xl-12 mb-4">
        <div class="card h-100">
            <div class="card-body d-flex justify-content-center flex-column">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="mr-7">
                        <i class="feather-xl text-green mb-3" data-feather="edit-3"></i>
                        <h5>Update Status Pasien Covid Case Peruri</h5>
                        {{-- <div class="text-muted"></div> --}}
                    </div>
                    <img class="img-fluid" src="{{ asset('/sb-admin-pro/dist/assets/img/freepik/windows-pana.svg')}}"
                        style="max-width: 20rem;" />
                </div>
            </div>


        </div>
    </div>
    @include('input_data.tbl_update')
</div>
@include('input_data.modal_update')
@include('input_data.modal_delete')
@include('input_data.modal_detail')



{{-- @include('dashboard.modal_change_passwd') --}}
@endsection
@section('scripts')

<script>
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
    $('.datepicker').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd/mm/yyyy',
        todayHighlight: true
    });
    $('#tglnegative_edit').datepicker({
        uiLibrary: 'bootstrap4',
        format: 'dd/mm/yyyy',
        todayHighlight: true
    });
    var ajaxParam = {
        url: "{{ route('data.index') }}",
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: function (d) {
            // d.id_process = $('#id_process').val(),
            //     d.id_dir = $('#id_dir').val(),
        }
    }
    var columnData = [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: 'nama',
            name: 'nama',

        },
        {
            data: 'np',
            name: 'np'
        },




        {
            data: 'direktorat',
            name: 'direktorat'
        },

        {
            data: 'unit',
            name: 'unit'
        },


        {
            data: 'divisi',
            name: 'divisi',
            // render: function (data, type, row) {
            //     var pengkali = data.toFixed(2)

            //     return pengkali + ' x GP'


            // }

        },
        {
            data: 'wilayah_kerja',
            name: 'wilayah_kerja',
            // render: function (data, type, row) {

            //     return addRp(numberWithCommas(data))

            // }

        },
        {
            data: 'gedung',
            name: 'gedung',
            // render: function (data, type, row) {

            //     return addRp(numberWithCommas(data))

            // }

        },
        {
            data: 'lantai',
            name: 'lantai',
            // render: function (data, type, row) {

            //     return addRp(numberWithCommas(data))

            // }

        },

        {
            data: 'kota',
            name: 'kota',
            // render: function (data, type, row) {
            //     return addRp(numberWithCommas(data))

            // }
        },
        {
            data: 'tempat_perawatan',
            name: 'tempat_perawatan',

        },
        {
            data: 'kluster_penyebaran',
            name: 'kluster_penyebaran',

        },
        {
            data: 'status_vaksin',
            name: 'status_vaksin',
            render: function (data, type, row) {
                
                if(data=='Vaksin Lengkap'){
return '<h6><span class="badge badge-success">Vaksin Lengkap</span><h6>'
                }else{
                    return '<h6><span class="badge badge-warning">'+data+'</span><h6>'
                }
            }

        },
        {
            data: 'tgl_positif',
            name: 'tgl_positif',
            render: function (data, type, row) {
                if (data == null || data == "-" || data == "0000-00-00" ||
                    data == "NULL") {
                    return '<span>-</span>'
                } else {
                    return moment(data).format('DD/MM/YYYY');
                }

            }
        },
        {
            data: 'tgl_negatif',
            name: 'tgl_negatif',
            render: function (data, type, row) {
                if (data == null || data == "-" || data == "0000-00-00" ||
                    data == "NULL") {
                    return '<span>-</span>'
                } else {
                    return moment(data).format('DD/MM/YYYY');
                }

            }
        },
        {
            data: 'status',
            name: 'status',
            render: function (data, type, row) {

                if(data=='Selesai'){
return '<h6><span class="badge badge-success">Selesai</span><h6>'
                }else{
                    return '<h6><span class="badge badge-warning">'+data+'</span><h6>'
                }
            }

        },
        {
            data: 'kondisi',
            name: 'kondisi',
            render: function (data, type, row) {

                if(data=='Tanpa Gejala'){
return '<h6><span class="badge badge-success">Selesai</span><h6>'
                }else{
                    return '<h6><span class="badge badge-warning">'+data+'</span><h6>'
                }
            }

        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        }
    ]

    var table = dataTables.comp('#tbl_update', ajaxParam, columnData)

    function convertDateTime(datetime){

        if(datetime==null || datetime=='' || datetime== "0000-00-00" || datetime== "-"){
            return '-'

        }else{
            return moment(datetime).format('DD/MM/YYYY HH:mm:s')
        }

    }
    function convertDate(date){

if(date==null || date=='' || date== "0000-00-00" || date== "-"){
    return '-'

}else{
    return moment(date).format('DD/MM/YYYY')
}

}

    $('#tbl_update tbody').on('click', '.detail', function () {

        var dataRow = table.row($(this).parents('tr')).data();
        console.log(dataRow)
        $('#np').val(dataRow.np)
        $('#nama').val(dataRow.nama)
        $('#direktorat').val(dataRow.direktorat)
        $('#divisi').val(dataRow.divisi)
        $('#unit').val(dataRow.unit)
        $('#wilayah_kerja').val(dataRow.wilayah_kerja)
        $('#gedung').val(dataRow.gedung)
        $('#lantai').val(dataRow.lantai)
        $('#isolasi').val(dataRow.tempat_isolasi)
        $('#perawatan').val(dataRow.tempat_perawatan)
        $('#klaster').val(dataRow.kluster_penyebaran)
        $('#tglpositif').val(convertDate(dataRow.tgl_positif))
        $('#tglnegative').val(convertDate(dataRow.tgl_negatif))
        $('#tgldibuat').val(convertDateTime(dataRow.created_at))
        $('#tglupdate').val(convertDateTime(dataRow.updated_at))
        $('#modalDetail').modal()
    });
    $('#myModal').on('hidden.bs.modal', function (e) {
        // do something...
    })
    $('#tbl_update tbody').on('click', '.edit', function () {
        console.log('tes')
        var dataRow = table.row($(this).parents('tr')).data();
        console.log(dataRow)
        $('#hidden_id').val(dataRow.id)
        $('#np_edit').val(dataRow.np).change()
        $('#nama_edit').val(dataRow.nama)
        $('#direktorat_edit').val(dataRow.nama_direktorat)
        $('#divisi_edit').val(dataRow.nama_divisi)
        $('#unit_edit').val(dataRow.nama_unit)
        $('#wilayah_kerja_edit').val(dataRow.wilayah_kerja).change()
        $('#gedung_edit').val(dataRow.gedung).change()
        $('#lantai_edit').val(dataRow.lantai).change()
        $('#isolasi_edit').val(dataRow.kota)
        $('#perawatan_edit').val(dataRow.tempat_perawatan).change()
        $('#klaster_edit').val(dataRow.kluster_penyebaran).change()
        $('#tglpositif_edit').val(convertDate(dataRow.tgl_positif))
        $('#tglnegative_edit').val(convertDate(dataRow.tgl_negatif))
        $('#status_edit').val(dataRow.status).change() 
        $('#vaksin_edit').val(dataRow.status_vaksin).change() 
        $('#kondisi_kasus_edit').val(dataRow.kondisi).change() 
        $('#modalUpdate').modal()

    });
    $('#myModal').on('hidden.bs.modal', function (e) {
        // do something...
    })
    var idKasus
    $('#tbl_update tbody').on('click', '.delete', function () {

        var dataRow = table.row($(this).parents('tr')).data();
        idKasus = dataRow.id
        $('#modalDelete').modal()
    });
    $('#confirm').on('click', function () {

        $.ajax({
            url: "/input/destroy/" + idKasus,
            beforeSend: function () {
                $('#confirm').text('Deleting...');
                $('#confirm').prop('disabled', true);
            },
            success: function (data) {
               
                if (data.error) {

                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: data.error,
                        showConfirmButton: false,
                        timer: 1500
                    })

                }
                if (data.success) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: data.success,
                        showConfirmButton: false,
                        timer: 1500
                    })

                }
                $('#confirm').text('Ya');
                $('#confirm').prop('disabled', false);
                $('#modalDelete').modal('hide');
                $('#tbl_update').DataTable().ajax.reload();


                // setTimeout(function () {

                // }, 2000);
            }
        })
    })
    $('#modalDelete').on('hidden.bs.modal', function (e) {

        // do something...
    }) 
        $('#edit_karyawan').on('submit', function (event) {
            event.preventDefault();
        sendUpdate(new FormData(this))
    })

    function sendUpdate(jsonData) {
        $.ajax({
            url: "{{ route('data.update') }}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content')
            },
            data: jsonData,
            contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
            beforeSend: function () {
                $('#simpan').text('proses menyimpan...');
                $('#simpan').prop('disabled', true);
            },
            success: function (data) {
                if (data.error) {

                    Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: data.error,
                        showConfirmButton: true,
                        // timer: 300
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

                }
                $('#simpan').text('Save changes');
                $('#simpan').prop('disabled', false);
                $('#modalUpdate').modal('hide');
                $('#tbl_update').DataTable().ajax.reload();

            }
        })


    }
    $('#np_edit').on('change', function () {
        // console.log($(this).val())
        getKaryawan($(this).val())
    })
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
             
            success: function (data) {
                var dataKaryawan = data.data
                console.log(data)
                $('#nama_edit').val(dataKaryawan.nama);
                $('#unit_edit').val(dataKaryawan.unit_kerja);
                $('#divisi_edit').val(dataKaryawan.divisi);
                $('#direktorat_edit').val(dataKaryawan.direktorat);
            }
        })
    }
    
</script>
@endsection
