@extends('layouts.app')
@section('title')
{{-- <h4 class="navbar-brand" href="javascript:;">Dashboard</h4> --}}
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card ">
                <div class="card-header card-header-text card-header-info">
                    <div class="card-text">
                        <h4 class="card-category">1. Upload Performance level</h4>
                    </div>
                </div>
                <div class="card-body ">
                    <a href="/downloadTemplatePL" name="template_pl" id="template_pl" data-toggle="tooltip"
                        data-placement="top" data-original-title="Detail" class="detail btn btn-primary btn-round">
                        <i class="material-icons">download</i> Download Template
                    </a>
                    <div class="card-text">
                        <h4 class="card-category">Upload File .XLSX</h4>
                        <h5 class="card-category">Data Performance Level Divisi</h5>
                    </div>
                    <input type="file" name="performance_level" id='performance_level' accept=".xlsx">
                    {{-- <div class="row">
                        <div class="col-md-12">
                            <img class="img" width="100%" src="{{ asset('/img/jp_new.jpg')}}" />
                </div>

            </div> --}}
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="card ">
        <div class="card-header card-header-text card-header-info">
            <div class="card-text">
                <h4 class="card-category">2. Upload Data Bonus Divisi</h4>
            </div>
        </div>
        <div class="card-body ">
            <a href="/downloadTemplateBonusDivisi" name="template_bonus_divisi" id="template_bonus_divisi" data-toggle="tooltip"
                data-placement="top" data-original-title="Detail" class="detail btn btn-primary btn-round">
                <i class="material-icons">download</i> Download Template
            </a>
            <div class="card-text">
                <h4 class="card-category">Upload File .XLSX</h4>
                <h5 class="card-category">Data Daftar Karyawan Bonus Divisi</h5>
            </div>
            <input type="file" name="bonus_divisi" id='bonus_divisi' accept=".xlsx">
            {{-- <div class="row">
                <div class="col-md-12">
                    <img class="img" width="100%" src="{{ asset('/img/jp_new.jpg')}}" />
        </div>

    </div> --}}
</div>
</div>
</div>
<div class="col-md-4">
    <div class="card ">
        <div class="card-header card-header-text card-header-warning">
            <div class="card-text">
                <h4 class="card-category">3. Upload Data Insentif Semester I</h4>
            </div>
        </div>
        <div class="card-body ">
            <a href="/downloadTemplateInsentif1" name="template_insentif_1" id="template_insentif_1" data-toggle="tooltip"
                data-placement="top" data-original-title="Detail" class="detail btn btn-primary btn-round">
                <i class="material-icons">download</i> Download Template
            </a>

            <div class="card-text">
                <h4 class="card-category">Upload File .XLSX</h4>
                <h5 class="card-category">Data Master Potongan (CD, Mangkir)</h5>
            </div>
            <input type="file" name="insentif_sms_1" id='insentif_sms_1' accept=".xlsx">
            {{-- <div class="row">
                        <div class="col-md-12">
                            <img class="img" width="100%" src="{{ asset('/img/jp_new.jpg')}}" />
        </div>

    </div> --}}
</div>
</div>
</div>
<div class="col-md-4">
    <div class="card ">
        <div class="card-header card-header-text card-header-warning">
            <div class="card-text">
                <h4 class="card-category">4. Upload Data Potongan Pegawai</h4>
            </div>
        </div>
        <div class="card-body ">
            <a href="/downloadTemplatePotongan" name="template_potongan" id="template_potongan" data-toggle="tooltip"
                data-placement="top" data-original-title="Detail" class="detail btn btn-primary btn-round">
                <i class="material-icons">download</i> Download Template
            </a>

            <div class="card-text">
                <h4 class="card-category">Upload File .XLSX</h4>
                <h5 class="card-category">Data Master Potongan (CD, Mangkir)</h5>
            </div>
            <input type="file" name="potongan" id='potongan' accept=".xlsx">
            {{-- <div class="row">
                        <div class="col-md-12">
                            <img class="img" width="100%" src="{{ asset('/img/jp_new.jpg')}}" />
        </div>

    </div> --}}
</div>
</div>
</div>

<div class="col-md-4">
    <div class="card ">
        <div class="card-header card-header-text card-header-success">
            <div class="card-text">
                <h4 class="card-category">5. Upload Master Distribusi Level</h4>
            </div>
        </div>
        <div class="card-body ">
            <a href="/downloadDistribusiLevel" name="template_dislvl" id="template_dislvl" data-toggle="tooltip"
                data-placement="top" data-original-title="Detail" class="detail btn btn-primary btn-round">
                <i class="material-icons">download</i> Download Template
            </a>

            <div class="card-text">
                <h4 class="card-category">Upload File .XLSX</h4>
                <h5 class="card-category">Master Data Distribusi Level</h5>
            </div>
            <input type="file" name="dislvl" id='dislvl' accept=".xlsx">
            {{-- <div class="row">
                        <div class="col-md-12">
                            <img class="img" width="100%" src="{{ asset('/img/jp_new.jpg')}}" />
        </div>

    </div> --}}
</div>
</div>
</div>
<div class="col-md-4">
    <div class="card ">
        <div class="card-header card-header-text card-header-success">
            <div class="card-text">
                <h4 class="card-category">6. Upload Master Pengkali Bonus</h4>
            </div>
        </div>
        <div class="card-body ">
            <a href="/downloadPengkaliBonus" name="template_pengkali" id="template_pengkali" data-toggle="tooltip"
                data-placement="top" data-original-title="Detail" class="detail btn btn-primary btn-round">
                <i class="material-icons">download</i> Download Template
            </a>

            <div class="card-text">
                <h4 class="card-category">Upload File .XLSX </h4>
                <h5 class="card-category">Data Pengkali Bonus Predikat Divisi</h5>
            </div>
            <input type="file" name="pengkali" id='pengkali' accept=".xlsx">
            {{-- <div class="row">
                        <div class="col-md-12">
                            <img class="img" width="100%" src="{{ asset('/img/jp_new.jpg')}}" />
        </div>

    </div> --}}
</div>
</div>
</div>
<div class="col-md-4">
    <div class="card ">
        <div class="card-header card-header-text card-header-primary">
            <div class="card-text">
                <h4 class="card-category">7. Upload Data Kepala Departemen</h4>
            </div>
        </div>
        <div class="card-body ">
            <a href="/downloadTemplateKadep" name="template_kadep" id="template_kadep" data-toggle="tooltip"
                data-placement="top" data-original-title="Detail" class="detail btn btn-primary btn-round">
                <i class="material-icons">download</i> Download Template
            </a>

            <div class="card-text">
                <h4 class="card-category">Upload File .XLSX</h4>
                <h5 class="card-category">Daftar Pegawai Kepala Departemen</h5>
            </div>
            <input type="file" name="kadep" id='kadep' accept=".xlsx">
            {{-- <div class="row">
                        <div class="col-md-12">
                            <img class="img" width="100%" src="{{ asset('/img/jp_new.jpg')}}" />
        </div>

    </div> --}}
</div>
</div>
</div>
<div class="col-md-4">
    <div class="card ">
        <div class="card-header card-header-text card-header-primary">
            <div class="card-text">
                <h4 class="card-category">8. Upload Data Kepala Divisi</h4>
            </div>
        </div>
        <div class="card-body ">
            <a href="/downloadTemplateKadiv" name="template_kadiv" id="template_kadiv" data-toggle="tooltip"
                data-placement="top" data-original-title="Detail" class="detail btn btn-primary btn-round">
                <i class="material-icons">download</i> Download Template
            </a>

            <div class="card-text">
                <h4 class="card-category">Upload File .XLSX</h4>
                <h5 class="card-category">Daftar Pegawai Kepala Divisi</h5>
            </div>
            <input type="file" name="kadiv" id='kadiv' accept=".xlsx">
            {{-- <div class="row">
                        <div class="col-md-12">
                            <img class="img" width="100%" src="{{ asset('/img/jp_new.jpg')}}" />
        </div>

    </div> --}}
</div>
</div>
</div>

<div class="col-md-4" hidden>
    <div class="card ">
        <div class="card-header card-header-text card-header-primary">
            <div class="card-text">
                <h4 class="card-category">Upload Master Pegawai</h4>
            </div>
        </div>
        <div class="card-body ">
            <button href="javascript:void(0);" name="template_pegawai" id="template_pegawai" data-toggle="tooltip"
                data-placement="top" data-original-title="Detail" class="detail btn btn-primary btn-round">
                <i class="material-icons">download</i> Download Template
            </button>
            <div class="card-text">
                <h4 class="card-category">Upload File .XLSX</h4>
            </div>
            <input type="file" name="pegawai" id='pegawai' accept=".xlsx">

        </div>
    </div>
</div>

</div>
</div>

{{-- @include('dashboard.modal_change_passwd') --}}
@endsection
@section('scripts')

<script>
    FilePond.registerPlugin(FilePondPluginFileValidateType);
    const inputElementPL = document.querySelector('input[id="performance_level"]');
    const pondPL = FilePond.create(inputElementPL);
    const inputElementBonusDivisi = document.querySelector('input[id="bonus_divisi"]');
    const pondBonusDivisi = FilePond.create(inputElementBonusDivisi);
    
    const inputElementPotongan = document.querySelector('input[id="potongan"]');
    const pondPotongan = FilePond.create(inputElementPotongan);
    const inputElementKadep = document.querySelector('input[id="kadep"]');
    const pondKadep = FilePond.create(inputElementKadep);
    const inputElementKadiv = document.querySelector('input[id="kadiv"]');
    const pondKadiv = FilePond.create(inputElementKadiv);
    const inputElementPegawai = document.querySelector('input[id="pegawai"]');
    const pondPegawai = FilePond.create(inputElementPegawai);
    const inputElementDisLevel = document.querySelector('input[id="dislvl"]');
    const pondDisLevel = FilePond.create(inputElementDisLevel);
    const inputElementPengkali = document.querySelector('input[id="pengkali"]');
    const pondPengkali = FilePond.create(inputElementPengkali);
    
    const inputElementInsentif1 = document.querySelector('input[id="insentif_sms_1"]');
    const pondInsentif1 = FilePond.create(inputElementInsentif1);
    

    


    pondPL.setOptions({
        // allowDrop: false,
        acceptedFileTypes: ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
        allowReplace: true,
        instantUpload: false,
        maxFiles: 1,
        server: {
            url: '/uploadPerformance',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });
    pondBonusDivisi.setOptions({
        // allowDrop: false,
        acceptedFileTypes: ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
        allowReplace: true,
        instantUpload: false,
        maxFiles: 1,
        server: {
            url: '/uploadBonusDivisi',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });

    
    pondPotongan.setOptions({
        // allowDrop: false,
        acceptedFileTypes: ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
        allowReplace: true,
        instantUpload: false,
        maxFiles: 1,
        server: {
            url: '/uploadPotongan',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });
    pondKadep.setOptions({
        // allowDrop: false,
        acceptedFileTypes: ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
        allowReplace: true,
        instantUpload: false,
        maxFiles: 1,
        server: {
            url: '/uploadKadep',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });
    pondKadiv.setOptions({
        // allowDrop: false,
        acceptedFileTypes: ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
        allowReplace: true,
        instantUpload: false,
        maxFiles: 1,
        server: {
            url: '/uploadKadiv',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });
    pondDisLevel.setOptions({
        // allowDrop: false,
        acceptedFileTypes: ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
        allowReplace: true,
        instantUpload: false,
        maxFiles: 1,
        server: {
            url: '/uploadDisLvl',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });


    
    pondPegawai.setOptions({
        // allowDrop: false,
        acceptedFileTypes: ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
        allowReplace: true,
        instantUpload: false,
        maxFiles: 1,
        server: {
            url: '/uploadPegawai',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });

    pondPengkali.setOptions({
        // allowDrop: false,
        acceptedFileTypes: ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
        allowReplace: true,
        instantUpload: false,
        maxFiles: 1,
        server: {
            url: '/uploadPengkali',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });
    pondInsentif1.setOptions({
        // allowDrop: false,
        acceptedFileTypes: ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'],
        allowReplace: true,
        instantUpload: false,
        maxFiles: 1,
        server: {
            url: '/uploadInsentif1',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });

    

    

</script>
@endsection
