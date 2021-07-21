@if (Auth::check())
@role(['admin'])
<div class="sidenav-menu">
    <div class="nav accordion" id="accordionSidenav">
        <div class="sidenav-menu-heading ">Dashboards</div>
        <a class="nav-link collapsed text-blue" href="javascript:void(0);" data-toggle="collapse"
            data-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
            <div class="nav-link-icon text-blue"><i data-feather="activity"></i></div>
            Dashboards
            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseDashboards" data-parent="#accordionSidenav">
            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                <a class="nav-link" href="{{route('home')}}">
                    Summary
                    {{-- <span class="badge badge-primary-soft text-primary ml-auto">Updated</span> --}}
                </a>

                {{-- <a class="nav-link" href="dashboard-3.html">
                  Lokasi Kerja
                  <span class="badge badge-primary-soft text-primary ml-auto">Updated</span>
              </a> --}}
            </nav>
        </div>

        <div class="sidenav-menu-heading">Data</div>
        <a class="nav-link collapsed text-green" href="javascript:void(0);" data-toggle="collapse"
            data-target="#collapseInput" aria-expanded="false" aria-controls="collapseInput">
            <div class="nav-link-icon text-green"><i data-feather="edit"></i></div>
            Input Data
            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>

        <div class="collapse" id="collapseInput" data-parent="#accordionSidenav">
            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                <a class="nav-link" href="{{route('data.input')}}">
                    Input Record
                    {{-- <span class="badge badge-primary-soft text-primary ml-auto">Updated</span> --}}
                </a>
                <a class="nav-link" href="{{route('data.daftar')}}">
                    Update Record
                    {{-- <span class="badge badge-primary-soft text-primary ml-auto">Updated</span> --}}
                </a>

            </nav>
        </div>
        <div class="sidenav-menu-heading">Reports</div>
        <a class="nav-link text-red" href="{{route('kasus.view')}}">
            <div class="nav-link-icon text-red"><i data-feather="book-open"></i></div>
            Report
        </a>

        {{-- <a href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();" class="nav-link">

        <i class="nav-icon fas fa-tree"></i>
        <p>Logout</p>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form> --}}

    </div>
</div>
<div class="sidenav-footer">
    <div class="sidenav-footer-content">
        <div class="sidenav-footer-subtitle">Logged in as: </div>
        {{-- Auth::user()) --}}
        <div class="sidenav-footer-title">{{auth()->user()->name}}</div>
    </div>
</div>
@endrole

@role(['super admin'])
<div class="sidenav-menu">
    <div class="nav accordion" id="accordionSidenav">
        <div class="sidenav-menu-heading">Dashboards</div>
        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse"
            data-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
            <div class="nav-link-icon"><i data-feather="activity"></i></div>
            Dashboards
            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseDashboards" data-parent="#accordionSidenav">
            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                <a class="nav-link" href="{{route('home')}}">
                    Summary
                    {{-- <span class="badge badge-primary-soft text-primary ml-auto">Updated</span> --}}
                </a>

                <a class="nav-link" href="{{route('view.lokasi')}}">
                    Lokasi Kerja
                    {{-- <span class="badge badge-primary-soft text-primary ml-auto">Updated</span> --}}
                </a>
            </nav>
        </div>

        <div class="sidenav-menu-heading">Data</div>
        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse" data-target="#collapseInput"
            aria-expanded="false" aria-controls="collapseInput">
            <div class="nav-link-icon"><i data-feather="activity"></i></div>
            Input Data
            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>

    </div>
</div>
@endrole


@role(['kadiv','direksi'])
<div class="sidenav-menu">
    <div class="nav accordion" id="accordionSidenav">
        <div class="sidenav-menu-heading">Dashboards</div>
        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse"
            data-target="#collapseDashboards" aria-expanded="false" aria-controls="collapseDashboards">
            <div class="nav-link-icon"><i data-feather="activity"></i></div>
            Dashboards
            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapseDashboards" data-parent="#accordionSidenav">
            <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavPages">
                <a class="nav-link" href="{{route('home')}}">
                    Summary

                </a>
            </nav>
        </div>
        <div class="sidenav-menu-heading">Reports</div>
        <a class="nav-link text-red" href="{{route('kasus.view')}}">
            <div class="nav-link-icon text-red"><i data-feather="book-open"></i></div>
            Report
        </a>

    </div>
</div>
@endrole

@endif
