<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon">
            <img class="img-profile rounded-circle" style="width: 52px; height: 52px;" src="{{asset('assets/img/avenga.png')}}" alt="logo">
        </div>
        <div class="sidebar-brand-text mx-3">Hi {{ Auth::user()->username }}</div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item {{ (request()->is('dashboard/riset')) ? 'active ' : '' }}">
        <a id="adminIndex" class="nav-link"
        hx-get="{{ url('dashboard/riset') }}" 
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
    @if (Auth::user()->role == 'admin')
    <li class="nav-item {{ (request()->is('pengajuan-riset')) ? 'active ' : '' }}">
        <a id="navCollapseZero"
        hx-get="{{ url('pengajuan-riset') }}" 
        hx-trigger="click" 
        hx-target="#app" 
        hx-swap="outerHTML transition:true"
        hx-push-url="true"
        hx-indicator="#loadingIndicator" class="nav-link">
        <i class="fa fa-fw fa-atom fa-xl"></i><span>Riset</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    @elseif (Auth::user()->role == 'user')
    {{--<li class="nav-item {{ (request()->is('dashboard/riset/user')) ? 'active ' : '' }}">
        <a class="nav-link"
        hx-get="{{ url('dashboard/riset/user') }}" 
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
    <hr class="sidebar-divider d-none d-md-block">--}}
    <li class="nav-item {{ (request()->is('pengajuan-riset')) ? 'active ' : '' }}">
        <a id="navCollapseZero"
        hx-get="{{ url('pengajuan-riset') }}" 
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
    @endif
</ul>