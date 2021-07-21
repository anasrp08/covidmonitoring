@extends('layouts.app')


<link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-html5-1.6.5/datatables.min.css" />

@section('header')
<header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
    <div class="container">
        <div class="page-header-content pt-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-auto mt-4">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><i data-feather="activity"></i></div>
                        Report Detail Pasien Covid Peruri
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
{{-- <div class="container"> --}}
<style>
    #tbl_kasus tbody tr {

        cursor: pointer;
    }

    .card-title-center {
        /* float: center !important;  */
        float: center;
        font-size: 1.1rem;
        font-weight: 400;
        margin: 0;
    }

    /* .dataTables_scroll
{
    overflow:auto;
} */
    /* .dt-body-nowrap {
        white-space: nowrap;
    } */

</style>
<div class="row">
    {{-- @include('report.report_all.f_filter') --}}
    {{-- @include('report.report_all.f_filter') --}}
</div>
<div class="row">
    {{-- @include('report.report_all.f_filter') --}}
    @include('report.report_all.tbl_data_kasus')
</div>
@endsection
@section('scripts')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script>
    $(document).ready(function () {
        $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
    // $('#tglpositif').datepicker({
    //     uiLibrary: 'bootstrap4',
    //     format: 'dd/mm/yyyy',
    //     todayHighlight: true
    // });
    $('#export').on('click',function(){
        // $("#export").attr("href", "/neraca/export/"+ $('#f_date').val())

        var query = {
                    tahun: moment().format('YYYY'),
                    status: '-',
                    jenispikai: '-',
                    seripikai:  '-',
                    tipepikai: '-',
                }



                $('#export').text('Downloading...');
                $('#export').prop('disabled',true);
                var url = "{{URL::to('report/report_data_kasus')}}?" + $.param(query)
                window.location = url;
                $('#export').text('Download Excel');
                $('#export').prop('disabled',false);
    })
    $('#filter').on('click',function(){

})

                // function getDropdown(paramUrl, param1, param2, idkomponen) {

                //     var paramData
                //     // console.log(param1)
                //     paramData = {
                //         id_dir: param2,
                //         // fisik: param2
                //     }
                //     $.ajax({
                //         url: paramUrl,
                //         method: 'POST',
                //         headers: {
                //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //         },
                //         data: paramData,
                //         success: function (data) {
                //             // if(data==''){

                //             // }
                //             // console.log(data)
                //             $('select[name="id_div"]').empty();
                //             $.each(data, function (key, value) {
                //                 $('select[name="id_div"]').append('<option value="' + key + '">' +
                //                     value + '</option>');
                //             });
                //             // console.log(data.html)
                //             // $("#id_div").html(data.html);
                //         }
                //     });
                // }
                var ajaxParam = {
                    url: "{{ route('kasus.data') }}",
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
                        data: 'np',
                        name: 'np'
                    },
                    {
                        data: 'nama',
                        name: 'nama',

                    },  
                    {
                        data: 'direktorat',
                        name: 'direktorat'
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
                        data: 'unit',
                        name: 'unit'
                    },

                    // {
                    //     data: 'kode_divisi',
                    //     name: 'kode_divisi',
                    //     // render: function (data, type, row) {
                    //     //     return addRp(numberWithCommas(data))

                    //     // }

                    // },
                   
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

                        //     var jumlahPotongan = parseInt(data) + parseInt(row.um)

                        //     return '- ' + addRp(numberWithCommas(jumlahPotongan))


                        // }
                    },
                    // {
                    //     data: 'provinsi',
                    //     name: 'provinsi',
                    //     // render: function (data, type, row) {
                    //     //     return addRp(numberWithCommas(data))

                    //     // }
                    // },
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

                            if (data == 'Vaksin Lengkap') {
                                return '<h6><span class="badge badge-success">' + data + '</span><h6>'
                            } else {
                                return '<h6><span class="badge badge-warning">' + data + '</span><h6>'
                            }
                        }
                        },
                        {
                            data: 'kondisi',
                            name: 'kondisi',
                            render: function (data, type, row) {

                                if (data == 'Tanpa Gejala') {
                                    return '<h6><span class="badge badge-success">' + data + '</span><h6>'
                                } else {
                                    return '<h6><span class="badge badge-warning">' + data + '</span><h6>'
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
                                    switch (data) {
                                        case 'PCR Negative':
                                        return '<h6><span class="badge badge-success">' + data + '</span><h6>'
                                            break;
                                            case 'PCR Positive':
                                            return '<h6><span class="badge badge-danger">' + data + '</span><h6>'
                                            break;
                                    
                                        default:
                                        return '<h6><span class="badge badge-warning">' + data + '</span><h6>'
                                            break;
                                    }
                                    
                                }

                            },
                            {
                                data: 'created_at',
                                name: 'created_at',
                                render: function (data, type, row) {
                                    if (data == null || data == "-" || data == "0000-00-00" ||
                                        data == "") {
                                        return '<span>-</span>'
                                    } else {
                                        return moment(data).format('DD/MM/YYYY');
                                    }

                                }
                            },
                            {
                                data: 'updated_at',
                                name: 'updated_at',
                                render: function (data, type, row) {
                                    if (data == null || data == "-" || data == "0000-00-00" ||
                                        data == "NULL") {
                                        return '<span>-</span>'
                                    } else {
                                        return moment(data).format('DD/MM/YYYY');
                                    }

                                }
                            },
        //                     {
        //     data: 'action',
        //     name: 'action',
        //     orderable: false,
        //     searchable: false
        // }
                        ]
                        var table = dataTables.comp('#tbl_kasus', ajaxParam, columnData)


                        table.columns.adjust().draw()





                    })

</script>
@endsection
