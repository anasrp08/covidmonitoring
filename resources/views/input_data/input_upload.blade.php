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
                                {{-- <div class="shadow rounded">
                                <div class="input-group input-group-joined input-group-joined-xl border-0">
                                    <input class="form-control" type="text" placeholder="Search..." aria-label="Search" autofocus />
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i data-feather="search"></i></span>
                                    </div>
                                </div>
                            </div> --}}
                            </div>
                            <div class="col-lg-3"><img class="img-fluid"
                                    src="{{ asset('/sb-admin-pro/dist/assets/img/freepik/problem-solving-pana.svg')}}" />
                            </div>
                        </div>
                        <nav class="nav nav-borders">
                            <a class="nav-link" href="{{route('data.input')}}">Input By Form</a>
                            <a class="nav-link active ml-0" href="{{route('data.input_upload')}}">Input By Upload
                                Excel</a>

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
    <div class="col-xxl-12 col-xl-12 mb-4">
        <div class="card h-100">
            <div class="card-body h-100 d-flex flex-column justify-content-center py-5 py-xl-4">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="col-xl-12 col-xxl-12 text-center"><img class="img-fluid"
                                src="{{ asset('/sb-admin-pro/dist/assets/img/freepik/data-report-pana.svg')}}"
                                style="max-width: 26rem;" /></div>
                    </div>
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="card-body ">
                                <a href="{{route('download.tempalate')}}" name="template" id="template" data-toggle="tooltip"
                                    data-placement="top" data-original-title="Download Template"
                                    class="detail btn btn-primary btn-round">
                                    <i class="fas fa-download"></i> Download Template
                                </a>
                                <div class="card-text">
                                    <h4 class="card-category">Upload File Dengan Tipe File .XLSX</h4>
                                </div>
                                <input type="file" name="upload_data" id='upload_data' accept=".xlsx">

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    {{-- @include('input_data.tbl_form') --}}
</div>



{{-- @include('dashboard.modal_change_passwd') --}}
@endsection
@section('scripts')

<script>
    FilePond.registerPlugin(FilePondPluginFileValidateType);
    const inputUploadData = document.querySelector('input[id="upload_data"]');
    const pondUploadData = FilePond.create(inputUploadData);
    let serverResponse = '';

    pondUploadData.setOptions({
        // allowDrop: false,
        acceptedFileTypes: ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
        allowReplace: true,
        instantUpload: false,
        maxFiles: 1,
        server: {
            process: {
                url: "{{route('upload')}}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                onload: (response) => {
                    console.log(serverResponse)
                    serverResponse = JSON.parse(response)
                    
                    if (serverResponse.error) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'error',
                            title: serverResponse.error,
                            showConfirmButton: true,
                            // timer: 1500
                        })
                    }
                    if (serverResponse.success) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: serverResponse.success,
                            showConfirmButton: true,
                            // timer: 1500
                        })
                    }

                },
                onerror: (response) => {

                    console.log(response)
                },
                labelFileProcessingComplete:()=>{
                return serverResponse;
            }
            },
            labelInvalidField: () => {
                return 'salah file';
            },

            labelFileLoadError: () => {
                // replaces the error on the FilePond error label
                return 'salah file';
            },
            labelFileProcessingError: () => {
                // replaces the error on the FilePond error label
                return serverResponse;
            },
          


        }
    });

    // var table=dataTables.com('#tbl_form',ajaxParam,columnData)

</script>
@endsection
