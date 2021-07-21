<div class="row">
    <div class="col-xxl-12">
        <!-- Tabbed dashboard card example-->
        <div class="card mb-12">
            <div class="card-header border-bottom">
                <!-- Dashboard card navigation-->
                <ul class="nav nav-tabs card-header-tabs" id="dashboardNav" role="tablist">
                    <li class="nav-item mr-1"><a class="nav-link active" id="overview-pill" href="#overview"
                            data-toggle="tab" role="tab" aria-controls="overview" aria-selected="true">Overview</a></li>
                    <li class="nav-item"><a class="nav-link" id="activities-pill" href="#activities" data-toggle="tab"
                            role="tab" aria-controls="activities" aria-selected="false">Perkembangan Kasus Aktif</a>
                    </li>
                    <li class="nav-item mr-1"><a class="nav-link" id="activities1-pill" href="#activities1"
                            data-toggle="tab" role="tab" aria-controls="activities1" aria-selected="false">Perkembangan
                            Kasus Sembuh</a>
                    </li>
                    <li class="nav-item mr-1"><a class="nav-link" id="activities2-pill" href="#activities2"
                        data-toggle="tab" role="tab" aria-controls="activities2" aria-selected="false">Peta Lokasi Kasus</a>
                </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="dashboardNavContent">
                    <!-- Dashboard Tab Pane 1-->
                    <div class="tab-pane fade show active" id="overview" role="tabpanel"
                        aria-labelledby="overview-pill">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="chart-area mb-4 mb-lg-0" style="height: 20rem;"><canvas id="akumulasi"
                                        width="100%" height="30"></canvas>
                                </div>
                                <div class="chart-area mb-4 mb-lg-0" style="height: 20rem;"><canvas id="casebydate"
                                        width="100%" height="30"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Dashboard Tab Pane 2-->
                    <div class="tab-pane fade" id="activities" role="tabpanel" aria-labelledby="activities-pill">
                        <button class="btn btn-white btn-sm line-height-normal p-3" id="chartrange">
                            <i class="mr-2 text-primary" data-feather="calendar"></i>
                            <span></span>
                            <i class="ml-1" data-feather="chevron-down"></i>
                        </button>
                        <button href="" name="export" id='download_bar' class="edit btn btn-primary edit-user">
                            <i class="fas fa-download"></i> Save as Image
                        </button>
                        <div class="card">
                            <div class="card-body h-75">
                                <canvas id="bar_overview" width="100%" height="60%;"></canvas>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header border-bottom">
                                <!-- Dashboard card navigation-->
                                <ul class="nav nav-tabs card-header-tabs" id="dashboardNav1" role="tablist">
                                    <li class="nav-item mr-1"><a class="nav-link active" id="dirdiv-pill" href="#dirdiv"
                                            data-toggle="tab" role="tab" aria-controls="dirdiv"
                                            aria-selected="true">Kasus Aktif Direktorat & Divisi</a></li>
                                    <li class="nav-item"><a class="nav-link" id="domisili-pill" href="#domisili"
                                            data-toggle="tab" role="tab" aria-controls="domisili"
                                            aria-selected="false">Kasus Aktif Domisili & Lokasi Isolasi</a></li>
                                    <li class="nav-item"><a class="nav-link" id="status-pill" href="#status"
                                            data-toggle="tab" role="tab" aria-controls="status"
                                            aria-selected="false">Kasus Aktif Klaster & Status Vaksin</a></li>

                                    <li class="nav-item"><a class="nav-link" id="areakerja-pill" href="#areakerja"
                                            data-toggle="tab" role="tab" aria-controls="areakerja"
                                            aria-selected="false">Kasus Aktif Area Kerja</a></li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="dashboardNavContent1">
                                    <!-- Dashboard Tab Pane 1-->
                                    <div class="tab-pane fade show active" id="dirdiv" role="tabpanel"
                                        aria-labelledby="dirdiv-pill">
                                        <div class="chart-area mb-5 mb-lg-0" style="height: 40rem;">


                                            <div class="row">

                                                <div class="col-lg-6">
                                                    <button href="" name="export" id='download_dir'
                                                        class="edit btn btn-primary edit-user">
                                                        <i class="fas fa-download"></i> Save as Image
                                                    </button>
                                                    <canvas id="pie_direktorat" width="100%" height="100"></canvas>

                                                </div>
                                                <div class="col-lg-6">
                                                    <button href="" name="export" id='download_div'
                                                        class="edit btn btn-primary edit-user">
                                                        <i class="fas fa-download"></i> Save as Image
                                                    </button>
                                                    <canvas id="pie_divisi" width="100%" height="100"></canvas>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="domisili" role="tabpanel"
                                        aria-labelledby="domisili-pill">
                                        <div class="chart-area mb-4 mb-lg-0" style="height: 60rem;">
                                            <div class="row">

                                                <div class="col-lg-6">
                                                    <button href="" name="export" id='download_domisili'
                                                        class="edit btn btn-primary edit-user">
                                                        <i class="fas fa-download"></i> Save as Image
                                                    </button>
                                                    <canvas id="pie_domisili" width="100%" height="100"></canvas>

                                                </div>
                                                <div class="col-lg-6">
                                                    <button href="" name="export" id='download_isolasi'
                                                        class="edit btn btn-primary edit-user">
                                                        <i class="fas fa-download"></i> Save as Image
                                                    </button>
                                                    <canvas id="pie_lokasi_isolasi" width="100%" height="100"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade " id="status" role="tabpanel"
                                        aria-labelledby="status-pill">
                                        <div class="chart-area mb-4 mb-lg-0" style="height: 60rem;">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <button href="" name="export" id='download_klaster'
                                                        class="edit btn btn-primary edit-user">
                                                        <i class="fas fa-download"></i> Save as Image
                                                    </button>
                                                    <canvas id="pie_klaster" width="100%" height="100"></canvas>
                                                </div>

                                                <div class="col-lg-6">
                                                    <button href="" name="export" id='download_vaksin'
                                                        class="edit btn btn-primary edit-user">
                                                        <i class="fas fa-download"></i> Save as Image
                                                    </button>
                                                    <canvas id="pie_statusvaksin" width="100%" height="80"></canvas>
                                                </div>
                                            </div>
                                            <div class="row justify-content-md-center">
                                                <div class="col-lg-6 text-center">
                                                    <button href="" name="export" id='download_gejala'
                                                        class="edit btn btn-primary edit-user">
                                                        <i class="fas fa-download"></i> Save as Image
                                                    </button>
                                                    <canvas id="pie_gejala" width="100%" height="80"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="tab-pane fade" id="areakerja" role="tabpanel"
                                        aria-labelledby="areakerja-pill">
                                        <div class="chart-area mb-8 mb-lg-0" style="height: 40rem;">
                                            <div class="row h-75">

                                                <div class=" col-lg-12">
                                                    <button href="" name="export" id='download_gedung'
                                                        class="edit btn btn-primary edit-user">
                                                        <i class="fas fa-download"></i> Save as Image
                                                    </button>
                                                    <canvas id="area_kerja" width="100%" height="60%;"></canvas>

                                                </div>
                                            </div>
                                            <div class="row h-75">
                                                <div class=" col-lg-12">
                                                    <button href="" name="export" id='download_unit'
                                                        class="edit btn btn-primary edit-user">
                                                        <i class="fas fa-download"></i> Save as Image
                                                    </button>
                                                    <canvas id="unit_kerja" width="100%" height="60%;"></canvas>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="activities1" role="tabpanel" aria-labelledby="activities1-pill">
                        <div class="chart-area mb-8 mb-lg-0" style="height: 40rem;">
                            <button class="btn btn-white btn-sm line-height-normal p-3" id="datesembuh">
                                <i class="mr-2 text-primary" data-feather="calendar"></i>
                                <span></span>
                                <i class="ml-1" data-feather="chevron-down"></i>
                            </button>


                            {{-- <div class="card"> --}}
                            {{-- <div class="card-body h-75"> --}}
                            <canvas id="sembuh_overview" width="100%" height="50%;"></canvas>

                            {{-- </div> --}}
                            {{-- </div> --}}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="activities2" role="tabpanel" aria-labelledby="activities2-pill">
                        <div class="chart-area mb-8 mb-lg-0" style="height: 50rem;">
                            <div class="card">
                                <div class="card-header border-bottom">
                            <ul class="nav nav-tabs card-header-tabs" id="dashboardNav2" role="tablist">
                                <li class="nav-item mr-1"><a class="nav-link active" id="peruri_jakarta-pill" href="#peruri_jakarta"
                                        data-toggle="tab" role="tab" aria-controls="peruri_jakarta"
                                        aria-selected="true">Lokasi Peruri Pusat</a></li>
                                <li class="nav-item"><a class="nav-link" id="peruri_krw-pill" href="#peruri_krw"
                                        data-toggle="tab" role="tab" aria-controls="peruri_krw"
                                        aria-selected="false">Lokasi Peruri Karawang</a></li>
                                 
                            </ul>
                                </div>
                                <div class="card-body">
                            <div class="tab-content" id="dashboardNavContent2">
                                <!-- Dashboard Tab Pane 1-->
                                <div class="tab-pane fade show active" id="peruri_jakarta" role="tabpanel"
                                    aria-labelledby="peruri_jakarta-pill">
                                    <div class="chart-area mb-10 mb-lg-0" style="height: 40rem;"> 
                                        <div class="col-lg-12">
                                        <div id="mapjkt"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="peruri_krw" role="tabpanel"
                                    aria-labelledby="peruri_krw-pill">
                                    <div class="chart-area mb-10 mb-lg-0" style="height: 40rem;">
                                        <div class="col-lg-12">
                                        <div id="mapkrw"></div>
                                        </div>
                                    </div>
                                </div>
 
                            </div>
                                </div>
                            </div>
                          
                            
                    </div>

                    {{-- <div class="tab-pane fade" id="sembuh" role="tabpanel" aria-labelledby="sembuh-pill">
                        <i class="ml-1" data-feather="chevron-down"></i>
                        <button class="btn btn-white btn-sm line-height-normal p-3" id="datesembuh">
                            <i class="mr-2 text-primary" data-feather="calendar"></i>
                            <span></span>
                            <i class="ml-1" data-feather="chevron-down"></i>
                        </button>

                        <div class="card">
                            <div class="card-body h-75">
                                <canvas id="sembuh_overview" width="100%" height="60%;"></canvas>

                            </div>
                        </div>

                    </div> --}}
                </div>
            </div>

        </div>
    </div>
</div>
