<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
    <li>
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
            <div class="sidebar-brand-icon">
                <img class="img-profile rounded-circle" style="width: 52px; height: 52px;" src="{{asset('assets/img/avenga.png')}}" alt="logo">
            </div>
            <div class="sidebar-brand-text mx-3">Hi {{ Auth::user()->username }}</div>
        </a>
    </li>
    
    <hr class="sidebar-divider my-0">
    @if (Auth::user()->role == 'admin')
    <li class="nav-item {{ (request()->is('admin')) ? 'active ' : '' }}">
        <a id="adminIndex" class="nav-link"
        hx-get="{{ url('admin') }}" 
        hx-trigger="click" 
        hx-target="#app" 
        hx-swap="outerHTML transition:true"
        hx-push-url="true"
        hx-indicator="#loadingIndicator">
        <i class="fas fa-fw fa-tachometer-alt fa-xl"></i>
        <span>Dashboard</span>
    </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item {{ (request()->is('data/*')) ? 'active ' : '' }}" id="databaseMenu">
        <a id="databaseNav" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseData" aria-expanded="true" aria-controls="collapseZero">
            <i class="fa fa-fw fa-brands fa-stack-overflow fa-xl"></i>
                <span>Database</span>
        </a>
        <div id="collapseData" class="collapse" aria-labelledby="headingData" data-parent="#accordionSidebar" style="z-index: 10">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item"
                hx-get="{{ url('data/profile') }}" 
                hx-trigger="click" 
                hx-target="#app" 
                hx-swap="outerHTML transition:true"
                hx-push-url="true"
                hx-indicator="#loadingIndicator"><i class="fas fa-fw fa-mosque"></i> Profil Pemda</a>
                <a class="collapse-item" href="{{ route('database') }}"
                hx-get="{{ route('database') }}" 
                hx-trigger="click" 
                hx-target="#app" 
                hx-swap="outerHTML transition:true"
                hx-push-url="true"
                hx-indicator="#loadingIndicator"><i class="fas fa-fw fa-rocket"></i> Inovasi Daerah</a>
                <a class="collapse-item" href="{{ url('all/inovations') }}"
                hx-get="{{ url('all/inovations') }}" 
                hx-trigger="click" 
                hx-target="#app" 
                hx-swap="outerHTML transition:true"
                hx-push-url="true"
                hx-indicator="#loadingIndicator"><i class="fas fa-fw fa-warehouse"></i> Semua Inovasi</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item {{ (request()->is('proyek/inovasi')) ? 'active ' : '' }}">
        <a id="navCollapseZero"
        hx-get="{{ url('proyek/inovasi') }}" 
        hx-trigger="click" 
        hx-target="#app" 
        hx-swap="outerHTML transition:true"
        hx-push-url="true"
        hx-indicator="#loadingIndicator" class="nav-link">
        <i class="fa fa-fw fa-rocket fa-xl"></i><span>Inovasi</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item {{ (request()->is('master/*')) ? 'active ' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fa fa-fw fa-filter fa-xl"></i>
            <span>Master</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar" style="z-index: 10;">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item"
                hx-get="{{ route('skpd.index') }}" 
                hx-trigger="click" 
                hx-target="#app" 
                hx-swap="outerHTML transition:true"
                hx-push-url="true"
                hx-indicator="#loadingIndicator"><i class="fas fa-fw fa-sitemap"></i> SKPD</a>
                <a class="collapse-item"
                hx-get="{{url('master/jenis')}}" 
                hx-trigger="click" 
                hx-target="#app" 
                hx-swap="outerHTML transition:true"
                hx-push-url="true"
                hx-indicator="#loadingIndicator"><i class="fas fa-fw fa-list"></i> Jenis</a>
                <a class="collapse-item"
                hx-get="{{url('master/bentuk')}}" 
                hx-trigger="click" 
                hx-target="#app" 
                hx-swap="outerHTML transition:true"
                hx-push-url="true"
                hx-indicator="#loadingIndicator"><i class="fas fa-fw fa-shapes"></i> Bentuk</a>
                <a class="collapse-item"
                hx-get="{{route('klasifikasi.index')}}" 
                hx-trigger="click" 
                hx-target="#app" 
                hx-swap="outerHTML transition:true"
                hx-push-url="true"
                hx-indicator="#loadingIndicator"><i class="fas fa-fw fa-solid fa-hurricane"></i>Klasifikasi Urusan</a>
                <a class="collapse-item"
                hx-get="{{route('urusan.index')}}" 
                hx-trigger="click" 
                hx-target="#app" 
                hx-swap="outerHTML transition:true"
                hx-push-url="true"
                hx-indicator="#loadingIndicator"><i class="fas fa-fw fa-info"></i> Urusan</a>
                <a class="collapse-item"
                hx-get="{{route('tematik.index')}}" 
                hx-trigger="click" 
                hx-target="#app" 
                hx-swap="outerHTML transition:true"
                hx-push-url="true"
                hx-indicator="#loadingIndicator"><i class="fas fa-fw fa-solid fa-dragon"></i> Tematik</a>
                <a class="collapse-item"
                hx-get="{{route('indikator.index')}}" 
                hx-trigger="click" 
                hx-target="#app" 
                hx-swap="outerHTML transition:true"
                hx-push-url="true"
                hx-indicator="#loadingIndicator"><i class="fas fa-fw fa-chart-simple"></i> Indikator</a>
                <a class="collapse-item"
                hx-get="{{route('bukti.index')}}" 
                hx-trigger="click" 
                hx-target="#app" 
                hx-swap="outerHTML transition:true"
                hx-push-url="true"
                hx-indicator="#loadingIndicator"><i class="fas fa-fw fa-solid fa-meteor"></i> Bukti</a>
                <a class="collapse-item"
                hx-get="{{route('inisiator.index')}}" 
                hx-trigger="click" 
                hx-target="#app" 
                hx-swap="outerHTML transition:true"
                hx-push-url="true"
                hx-indicator="#loadingIndicator"><i class="fas fa-fw fa-lightbulb"></i> Inisiator</a>
                <a class="collapse-item"
                hx-get="{{route('tahapan.index')}}" 
                hx-trigger="click" 
                hx-target="#app" 
                hx-swap="outerHTML transition:true"
                hx-push-url="true"
                hx-indicator="#loadingIndicator"><i class="fas fa-fw fa-bars-progress"></i> Tahapan</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item {{ (request()->is('users')) ? 'active ' : '' }}">
        <a class="nav-link"
        hx-get="{{ url('users') }}" 
        hx-trigger="click" 
        hx-target="#app" 
        hx-swap="outerHTML transition:true"
        hx-push-url="true"
        hx-indicator="#loadingIndicator"><i class="fas fa-fw fa-user fa-xl"></i><span>Users</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item {{ (request()->is('setting/*')) ? 'active ' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fa fa-fw fa-gear fa-xl"></i>
            <span>Settings</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar" style="z-index: 10;">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" hx-get="{{ url('system/setting') }}" 
                hx-trigger="click" 
                hx-target="#app" 
                hx-swap="outerHTML transition:true"
                hx-push-url="true"
                hx-indicator="#loadingIndicator"><i class="fas fa-fw fa-wrench"></i> Web setting</a>
                <a class="collapse-item"
                hx-get="{{ url('carousel') }}" 
                hx-trigger="click" 
                hx-target="#app" 
                hx-swap="outerHTML transition:true"
                hx-push-url="true"
                hx-indicator="#loadingIndicator"><i class="fas fa-fw fa-image"></i> Carousel</a>
                <a class="collapse-item"
                hx-get="{{ url('background') }}" 
                hx-trigger="click" 
                hx-target="#app" 
                hx-swap="outerHTML transition:true"
                hx-push-url="true"
                hx-indicator="#loadingIndicator"><i class="fa-solid fa-panorama"></i> Background</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item {{ (request()->is('messages')) ? 'active ' : '' }}">
        <a class="nav-link"
        hx-get="{{ url('messages') }}" 
        hx-trigger="click" 
        hx-target="#app" 
        hx-swap="outerHTML transition:true"
        hx-push-url="true"
        hx-indicator="#loadingIndicator">
            <i class="fas fa-fw fa-envelope fa-xl"></i>
            <span>Messages</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item {{ (request()->is('backup')) ? 'active ' : '' }}">
        <a class="nav-link"
        hx-get="{{ url('backup') }}" 
        hx-trigger="click" 
        hx-target="#app" 
        hx-swap="outerHTML transition:true"
        hx-push-url="true"
        hx-indicator="#loadingIndicator">
            <i class="fas fa-fw fa-database fa-xl"></i>
            <span>Backup</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    @elseif (Auth::user()->role == 'user')
    <li class="nav-item {{ (request()->is('user')) ? 'active ' : '' }}">
        <a class="nav-link"
        hx-get="{{ url('user') }}" 
        hx-trigger="click" 
        hx-target="#app" 
        hx-swap="outerHTML transition:true"
        hx-push-url="true"
        hx-indicator="#loadingIndicator">
            <i class="fas fa-fw fa-tachometer-alt fa-xl"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item {{ (request()->is('proyek/*')) ? 'active ' : '' }}">
        <a id="navCollapseZero"
        hx-get="{{ url('proyek/inovasi') }}" 
        hx-trigger="click" 
        hx-target="#app" 
        hx-swap="outerHTML transition:true"
        hx-push-url="true"
        hx-indicator="#loadingIndicator" class="nav-link">
        <i class="fa fa-fw fa-rocket fa-xl"></i>
        <span>Inovasi</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item {{ (request()->is('proyek/*')) ? 'active ' : '' }}">
        <a id="navCollapseZero"
        hx-get="{{ url('proyek/inovasi') }}" 
        hx-trigger="click" 
        hx-target="#app" 
        hx-swap="outerHTML transition:true"
        hx-push-url="true"
        hx-indicator="#loadingIndicator" class="nav-link" hx-disable>
        <i class="fa fa-fw fa-microscope fa-xl"></i>
        <span>Litbang</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item {{ (request()->is('proyek/*')) ? 'active ' : '' }}">
        <a id="navCollapseZero"
        hx-get="{{ url('proyek/inovasi') }}" 
        hx-trigger="click" 
        hx-target="#app" 
        hx-swap="outerHTML transition:true"
        hx-push-url="true"
        hx-indicator="#loadingIndicator" class="nav-link" hx-disable>
        <i class="fa fa-fw fa-atom fa-xl"></i>
        <span>Riset</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item {{ (request()->is('notes')) ? 'active ' : '' }}">
        <a id="navCollapseZero"
        hx-get="{{ url('note') }}" 
        hx-trigger="click" 
        hx-target="#app" 
        hx-swap="outerHTML transition:true"
        hx-push-url="true"
        hx-indicator="#loadingIndicator" class="nav-link" hx-disable>
        <i class="fa fa-fw fa-clipboard fa-xl"></i>
        <span>Notes</span>
        </a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    @endif
</ul>