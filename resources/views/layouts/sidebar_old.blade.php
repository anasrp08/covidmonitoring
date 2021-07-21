<div class="sidebar-wrapper">
    <div class="user">
      <div class="photo">
        <img src="{{ asset('/material-bootstrap//img/faces/avatar.jpg')}}" />
      </div>
      <div class="user-info">
        <a data-toggle="collapse" href="#collapseExample" class="username">
          <span id='namaUser'>
            {{auth()->user()->name}}
            <b class="caret"></b>
          </span>
        </a>
        <div class="collapse" id="collapseExample">
          <ul class="nav">
            
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/settings/password') }}">
                <span class="sidebar-mini"> GP </span>
                <span class="sidebar-normal"> Ganti Password </span>
              </a>
            </li>
             
          </ul>
        </div>
      </div>
    </div>
    <ul class="nav">
      <li class="nav-item {!! Request::is('/') ? 'active' : '' !!}">
        <a class="nav-link" href="{{url('/')}}">
          <i class="material-icons">dashboard</i>
          <p> Dashboard </p>
        </a>
      </li>
      @role(['admin','Direktur','Direktur Utama'])
      <li class="nav-item  ">
        <a class="nav-link" data-toggle="collapse" href="#pagesExamples">
          <i class="material-icons">timeline</i>
          <p> Master Bonus
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ (request()->is('master/*')) ? 'show' : '' }}" id="pagesExamples">
          <ul class="nav">
            <li class="nav-item {{ (request()->is('master/master_jp')) ? 'active' : '' }}   ">
              <a class="nav-link" href="{{ route('master.master_jp') }}">
                <span class="sidebar-mini">1. </span>
                <span class="sidebar-normal">Master Pooling </span>
              </a>
            </li>
            
            
            <li class="nav-item {{ (request()->is('master/master_manajemen/*')) ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('master.manajemen') }}">
                <span class="sidebar-mini">2. </span>
                <span class="sidebar-normal">Pooling Direktorat </span>
              </a>
            </li>
            <li class="nav-item  {{ (request()->is('master/master_divisi/*')) ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('master.divisi') }}">
                <span class="sidebar-mini">3. </span>
                <span class="sidebar-normal">Pooling Divisi </span>
              </a>
            </li>
            <li class="nav-item  {{ (request()->is('master/master_batas/*')) ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('master.batas') }}">
                <span class="sidebar-mini">4. </span>
                <span class="sidebar-normal">Parameter Min / Max </span>
              </a>
            </li>
            <li class="nav-item  {{ (request()->is('master/master_upload')) ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('master.upload') }}">
                <span class="sidebar-mini">5. </span>
                <span class="sidebar-normal">Upload Data </span>
              </a>
            </li>
            <li class="nav-item  {{ (request()->is('master/master_faktor')) ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('faktor.view') }}">
                <span class="sidebar-mini">6. </span>
                <span class="sidebar-normal">Tembak Faktor</span>
              </a>
            </li>
            
            {{-- <li class="nav-item  {{ (request()->is('master/master_upload')) ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('master.batas') }}">
                <span class="sidebar-mini">6. </span>
                <span class="sidebar-normal">Master Max Apresiasi </span>
              </a>
            </li> --}}

          </ul>
        </div>
      </li>
      @endrole
      <li class="nav-item {!! Request::is('performance_level/*') ? 'active' : '' !!}">
        <a class="nav-link" href="{{ route('performance.list') }}">
          <i class="material-icons">content_paste</i>
          <p> Performance Level </p>
        </a>
      </li>
      @role(['admin','Direktur','Direktur Utama'])
      <li class="nav-item {!! Request::is('bonus_kadiv/*') ? 'active' : '' !!}">
        <a class="nav-link" href="{{ route('tahun_bonus.list') }}">
          <i class="material-icons">widgets</i>
          <p> Bonus Kepala Divisi </p>
        </a>
      </li>
      <li class="nav-item {!! Request::is('bonus_kadep/*') ? 'active' : '' !!}">
        <a class="nav-link" href="{{ route('tahun_bonus_kadep.list') }}">
          <i class="material-icons">apps</i>
          <p> Bonus Kepala Dept. </p>
        </a>
      </li>
      @endrole
      <li class="nav-item {!! Request::is('bonus_divisi/*') ? 'active' : '' !!}">
        <a class="nav-link" href="{{ route('bonus_tahun.list') }}">
          <i class="material-icons">grid_on</i>
          <p> Bonus Divisi </p>
        </a>
      </li>

     
      <li class="nav-item {{ (request()->is('report/reportall*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('view.reportall') }}">
          <i class="material-icons">cloud</i>
          <p> Report </p>
        </a>
      </li>
      {{-- <li class="nav-item ">
        <a class="nav-link" href="../examples/widgets.html">
          <i class="material-icons">person</i>
          <p> Account </p>
        </a>
      </li> --}}
      <li class="nav-item ">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();localStorage.clear();">
          <i class="material-icons">logout</i>
          <p> Logout </p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
      </li>

{{--       
      <li class="nav-item ">
        <a class="nav-link" data-toggle="collapse" href="#componentsExamples">
          <i class="material-icons">apps</i>
          <p> Components
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="componentsExamples">
          <ul class="nav">
            <li class="nav-item ">
              <a class="nav-link" data-toggle="collapse" href="#componentsCollapse">
                <span class="sidebar-mini"> MLT </span>
                <span class="sidebar-normal"> Multi Level Collapse
                  <b class="caret"></b>
                </span>
              </a>
              <div class="collapse" id="componentsCollapse">
                <ul class="nav">
                  <li class="nav-item ">
                    <a class="nav-link" href="#0">
                      <span class="sidebar-mini"> E </span>
                      <span class="sidebar-normal"> Example </span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="../examples/components/buttons.html">
                <span class="sidebar-mini"> B </span>
                <span class="sidebar-normal"> Buttons </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="../examples/components/grid.html">
                <span class="sidebar-mini"> GS </span>
                <span class="sidebar-normal"> Grid System </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="../examples/components/panels.html">
                <span class="sidebar-mini"> P </span>
                <span class="sidebar-normal"> Panels </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="../examples/components/sweet-alert.html">
                <span class="sidebar-mini"> SA </span>
                <span class="sidebar-normal"> Sweet Alert </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="../examples/components/notifications.html">
                <span class="sidebar-mini"> N </span>
                <span class="sidebar-normal"> Notifications </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="../examples/components/icons.html">
                <span class="sidebar-mini"> I </span>
                <span class="sidebar-normal"> Icons </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="../examples/components/typography.html">
                <span class="sidebar-mini"> T </span>
                <span class="sidebar-normal"> Typography </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item ">
        <a class="nav-link" data-toggle="collapse" href="#formsExamples">
          <i class="material-icons">content_paste</i>
          <p> Forms
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="formsExamples">
          <ul class="nav">
            <li class="nav-item ">
              <a class="nav-link" href="../examples/forms/regular.html">
                <span class="sidebar-mini"> RF </span>
                <span class="sidebar-normal"> Regular Forms </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="../examples/forms/extended.html">
                <span class="sidebar-mini"> EF </span>
                <span class="sidebar-normal"> Extended Forms </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="../examples/forms/validation.html">
                <span class="sidebar-mini"> VF </span>
                <span class="sidebar-normal"> Validation Forms </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="../examples/forms/wizard.html">
                <span class="sidebar-mini"> W </span>
                <span class="sidebar-normal"> Wizard </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item ">
        <a class="nav-link" data-toggle="collapse" href="#tablesExamples">
          <i class="material-icons">grid_on</i>
          <p> Tables
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="tablesExamples">
          <ul class="nav">
            <li class="nav-item ">
              <a class="nav-link" href="../examples/tables/regular.html">
                <span class="sidebar-mini"> RT </span>
                <span class="sidebar-normal"> Regular Tables </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="../examples/tables/extended.html">
                <span class="sidebar-mini"> ET </span>
                <span class="sidebar-normal"> Extended Tables </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="../examples/tables/datatables.net.html">
                <span class="sidebar-mini"> DT </span>
                <span class="sidebar-normal"> DataTables.net </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item ">
        <a class="nav-link" data-toggle="collapse" href="#mapsExamples">
          <i class="material-icons">place</i>
          <p> Maps
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="mapsExamples">
          <ul class="nav">
            <li class="nav-item ">
              <a class="nav-link" href="../examples/maps/google.html">
                <span class="sidebar-mini"> GM </span>
                <span class="sidebar-normal"> Google Maps </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="../examples/maps/fullscreen.html">
                <span class="sidebar-mini"> FSM </span>
                <span class="sidebar-normal"> Full Screen Map </span>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="../examples/maps/vector.html">
                <span class="sidebar-mini"> VM </span>
                <span class="sidebar-normal"> Vector Map </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="../examples/widgets.html">
          <i class="material-icons">widgets</i>
          <p> Widgets </p>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="../examples/charts.html">
          <i class="material-icons">timeline</i>
          <p> Charts </p>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="../examples/calendar.html">
          <i class="material-icons">date_range</i>
          <p> Calendar </p>
        </a>
      </li>
    </ul> --}}
  </div> 