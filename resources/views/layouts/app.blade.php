<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('title')
        {{-- <title>Dashboard - SB Admin Pro</title>  --}}
        
        <link href="{{ asset('/sb-admin-pro/dist/css/styles.css')}}" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="{{ asset('/sb-admin-pro/assets/dist/img/favicon.png')}}" />
        <link href="{{ asset('/sb-admin-pro/dataTables.bootstrap4.min.css')}}" rel="stylesheet" crossorigin="anonymous" />
        <link href="{{ asset('/sb-admin-pro/daterangepicker.css')}}" rel="stylesheet" crossorigin="anonymous" />
        <script data-search-pseudo-elements defer src="{{ asset('/sb-admin-pro/font-awesome-all.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{ asset('/sb-admin-pro/feather.min.js')}}" crossorigin="anonymous"></script> 
        <link rel="stylesheet" href="{{ asset('/sb-admin-pro/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}"> 
        {{-- <link rel="stylesheet" href="{{ asset('/adminlte3/plugins/otherplugin/select/select1.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{ asset('/adminlte3/plugins/otherplugin/button/buttons.bootstrap4.min.css')}}">
        <script src="{{ asset('/adminlte3/plugins/otherplugin/select/dataTables.select1.min.js') }}"></script> 
        <script src="{{ asset('/adminlte3/plugins/otherplugin/button/dataTables.buttons.min.js') }}"></script> --}}
        {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
        <link href="{{ asset('/sb-admin-pro/bootstrap.min.css')}}" rel="stylesheet" crossorigin="anonymous" />
        
        <link rel="stylesheet" href="{{ asset('/sb-admin-pro/select2.min.css')}}">
        <link rel="stylesheet" href="{{ asset('/sb-admin-pro/select2-bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{ asset('/sb-admin-pro/select/select1.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{ asset('/sb-admin-pro/button/buttons.bootstrap4.min.css')}}">
        {{-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin=""/> --}}
        <link rel="stylesheet" href="{{ asset('/sb-admin-pro/leaflet.css')}}"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin=""/>
        
        <link rel="stylesheet" href="{{ asset('/sb-admin-pro/leaflet.label.css')}}">
        {{-- <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script> --}}
        <script src="{{ asset('/sb-admin-pro/leaflet.js')}}"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
        <script src="{{ asset('/sb-admin-pro/leaflet.label.js')}}"></script> 
      </head>
    <body class="nav-fixed sidenav-toggled">
        <nav class="topnav navbar navbar-expand shadow navbar-light bg-white" id="sidenavAccordion">
            <a class="navbar-brand" href="{{url('/home')}}">Data Covid Peruri</a>
            <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle" href="#"><i data-feather="menu"></i></button>
            {{-- <form class="form-inline mr-auto d-none d-md-block">
                <div class="input-group input-group-joined input-group-solid">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
                    <div class="input-group-append">
                        <div class="input-group-text"><i data-feather="search"></i></div>
                    </div>
                </div>
            </form> --}}
            <ul class="navbar-nav align-items-center ml-auto">
                {{-- <li class="nav-item dropdown no-caret mr-3 d-none d-md-inline">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownDocs" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="d-none d-md-inline font-weight-500">Documentation</div>
                        <i class="fas fa-chevron-right dropdown-arrow"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right py-0 mr-sm-n15 mr-lg-0 o-hidden animated--fade-in-up" aria-labelledby="navbarDropdownDocs">
                        <a class="dropdown-item py-3" href="https://docs.startbootstrap.com/sb-admin-pro" target="_blank">
                            <div class="icon-stack bg-primary-soft text-primary mr-4"><i data-feather="book"></i></div>
                            <div>
                                <div class="small text-gray-500">Documentation</div>
                                Usage instructions and reference
                            </div>
                        </a>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item py-3" href="https://docs.startbootstrap.com/sb-admin-pro/components" target="_blank">
                            <div class="icon-stack bg-primary-soft text-primary mr-4"><i data-feather="code"></i></div>
                            <div>
                                <div class="small text-gray-500">Components</div>
                                Code snippets and reference
                            </div>
                        </a>
                        <div class="dropdown-divider m-0"></div>
                        <a class="dropdown-item py-3" href="https://docs.startbootstrap.com/sb-admin-pro/changelog" target="_blank">
                            <div class="icon-stack bg-primary-soft text-primary mr-4"><i data-feather="file-text"></i></div>
                            <div>
                                <div class="small text-gray-500">Changelog</div>
                                Updates and changes
                            </div>
                        </a>
                    </div>
                </li> --}}
                {{-- <li class="nav-item dropdown no-caret mr-3 d-md-none">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="search"></i></a>
                    <!-- Dropdown - Search-->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--fade-in-up" aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100">
                            <div class="input-group input-group-joined input-group-solid">
                                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                                <div class="input-group-append">
                                    <div class="input-group-text"><i data-feather="search"></i></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item dropdown no-caret mr-3 dropdown-notifications">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="bell"></i></a>
                    <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownAlerts">
                        <h6 class="dropdown-header dropdown-notifications-header">
                            <i class="mr-2" data-feather="bell"></i>
                            Alerts Center
                        </h6>
                        <a class="dropdown-item dropdown-notifications-item" href="#!">
                            <div class="dropdown-notifications-item-icon bg-warning"><i data-feather="activity"></i></div>
                            <div class="dropdown-notifications-item-content">
                                <div class="dropdown-notifications-item-content-details">December 29, 2019</div>
                                <div class="dropdown-notifications-item-content-text">This is an alert message. It's nothing serious, but it requires your attention.</div>
                            </div>
                        </a>
                        <a class="dropdown-item dropdown-notifications-item" href="#!">
                            <div class="dropdown-notifications-item-icon bg-info"><i data-feather="bar-chart"></i></div>
                            <div class="dropdown-notifications-item-content">
                                <div class="dropdown-notifications-item-content-details">December 22, 2019</div>
                                <div class="dropdown-notifications-item-content-text">A new monthly report is ready. Click here to view!</div>
                            </div>
                        </a>
                        <a class="dropdown-item dropdown-notifications-item" href="#!">
                            <div class="dropdown-notifications-item-icon bg-danger"><i class="fas fa-exclamation-triangle"></i></div>
                            <div class="dropdown-notifications-item-content">
                                <div class="dropdown-notifications-item-content-details">December 8, 2019</div>
                                <div class="dropdown-notifications-item-content-text">Critical system failure, systems shutting down.</div>
                            </div>
                        </a>
                        <a class="dropdown-item dropdown-notifications-item" href="#!">
                            <div class="dropdown-notifications-item-icon bg-success"><i data-feather="user-plus"></i></div>
                            <div class="dropdown-notifications-item-content">
                                <div class="dropdown-notifications-item-content-details">December 2, 2019</div>
                                <div class="dropdown-notifications-item-content-text">New user request. Woody has requested access to the organization.</div>
                            </div>
                        </a>
                        <a class="dropdown-item dropdown-notifications-footer" href="#!">View All Alerts</a>
                    </div>
                </li>
                <li class="nav-item dropdown no-caret mr-3 dropdown-notifications">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownMessages" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="mail"></i></a>
                    <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownMessages">
                        <h6 class="dropdown-header dropdown-notifications-header">
                            <i class="mr-2" data-feather="mail"></i>
                            Message Center
                        </h6>
                        <a class="dropdown-item dropdown-notifications-item" href="#!">
                            <img class="dropdown-notifications-item-img" src="https://source.unsplash.com/vTL_qy03D1I/60x60" />
                            <div class="dropdown-notifications-item-content">
                                <div class="dropdown-notifications-item-content-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                                <div class="dropdown-notifications-item-content-details">Emily Fowler · 58m</div>
                            </div>
                        </a>
                        <a class="dropdown-item dropdown-notifications-item" href="#!">
                            <img class="dropdown-notifications-item-img" src="https://source.unsplash.com/4ytMf8MgJlY/60x60" />
                            <div class="dropdown-notifications-item-content">
                                <div class="dropdown-notifications-item-content-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</div>
                                <div class="dropdown-notifications-item-content-details">Diane Chambers · 2d</div>
                            </div>
                        </a>
                        <a class="dropdown-item dropdown-notifications-footer" href="#!">Read All Messages</a>
                    </div>
                </li> --}}
                {{-- <li class="nav-item dropdown no-caret mr-2 dropdown-user">
                    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="img-fluid" src="https://source.unsplash.com/QAB-WJcbgJk/60x60" /></a>
                    <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                        <h6 class="dropdown-header d-flex align-items-center">
                            <img class="dropdown-user-img" src="https://source.unsplash.com/QAB-WJcbgJk/60x60" />
                            <div class="dropdown-user-details">
                                <div class="dropdown-user-details-name">Valerie Luna</div>
                                <div class="dropdown-user-details-email">vluna@aol.com</div>
                            </div>
                        </h6>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#!">
                            <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                            Account
                        </a> --}}
                        {{-- <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();localStorage.clear();">
                            <i class="material-icons">logout</i>
                            <p> Logout </p>
                          </a> --}}
                        {{-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();localStorage.clear();"">
                            <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                            Logout
                        </a> --}}
                    {{-- </div>
                </li> --}}
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sidenav shadow-right sidenav-light">
                  @include('layouts.sidebar')
                    
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    @yield('header')
                    
                    <!-- Main page content-->
                    <div class="container mt-n10">
                      @yield('content')

                    
                    </div>
                </main>
                {{-- <footer class="footer mt-auto footer-light">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 small">Copyright &copy;Peruri {!! date("Y") !!} </div>
                            <div class="col-md-6 text-md-right small">
                                <a href="#!">Privacy Policy</a>
                                &middot;
                                <a href="#!">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer> --}}
            </div>
        </div>
       
        <script src="{{ asset('/sb-admin-pro/jquery-3.5.1.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('/sb-admin-pro/select2/js/select2.full.min.js') }}"></script>
        <script src="{{ asset('/sb-admin-pro/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('/sb-admin-pro/dist/js/scripts.js')}}"></script>
        <script src="{{ asset('/sb-admin-pro/Chart.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('/sb-admin-pro/chartjs-plugin-datalabels@0.7.0.js') }}" crossorigin="anonymous"></script>
        
        {{-- <script src="{{ asset('/sb-admin-pro/dist/assets/demo/chart-area-demo.js')}}"></script> --}}
        {{-- <script src="{{ asset('/sb-admin-pro/dist/assets/demo/chart-bar-demo.js')}}"></script> --}}
        <script src="{{ asset('/sb-admin-pro/jquery.dataTables.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('/sb-admin-pro/dataTables.bootstrap4.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('/sb-admin-pro/dist/assets/demo/datatables-demo.js')}}"></script>
        <script src="{{ asset('/sb-admin-pro/moment.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('/sb-admin-pro/daterangepicker.min.js') }}" crossorigin="anonymous"></script>
        {{-- <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script> --}}
        <script src="{{ asset('/sb-admin-pro/dist/assets/demo/chart-bar-overview.js')}}"></script>
        <script src="{{ asset('/sb-admin-pro/dist/assets/demo/chart-area.js')}}"></script>
        <script src="{{ asset('/sb-admin-pro/dist/assets/demo/chart-pie-persebaran.js')}}"></script>
        <script src="{{ asset('/sb-admin-pro/dist/js/moment-with-locales.min.js')}}"></script>
        <link href="{{ asset('/sb-admin-pro/filepond.css')}}" rel="stylesheet" />
        <script src="{{ asset('/sb-admin-pro/filepond.js')}}" rel="stylesheet"></script>
        
        {{-- <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script> --}}
        <script src="{{ asset('/sb-admin-pro/sweetalert2.all.min.js')}}"></script>
        <script src="{{ asset('/sb-admin-pro/filepond-plugin-file-validate-type.js')}}" rel="stylesheet"></script>
        <script src="{{ asset('/sb-admin-pro/dist/assets/demo/datatables.js')}}"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
        
        <script src="{{ asset('/sb-admin-pro/bootstrap.min.js') }}"  crossorigin="anonymous"></script>
<!-- select2 -->
<script src="{{ asset('/sb-admin-pro/select2.min.js') }}" crossorigin="anonymous"></script>
       
<script src="{{ asset('/sb-admin-pro/gijgo/gijgo.min.js')}}" type="text/javascript"></script>
<link href="{{ asset('/sb-admin-pro/gijgo/gijgo.min.css')}}" rel="stylesheet" type="text/css" />
<script src="{{ asset('/sb-admin-pro/select/dataTables.select1.min.js') }}"></script> 
<script src="{{ asset('/sb-admin-pro/button/dataTables.buttons.min.js') }}"></script>
{{-- <script src="{{ asset('/adminlte3/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"> --}}
{{-- </script> --}}
@yield('scripts')
      </body>
</html>
