@extends('layouts.riset-menus')
@section('content')
<!-- Begin Page Content -->
@fragment('dashboard')
            <div class="container-fluid slide-it" id="app" hx-history="false">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-dark">Dashboard Riset</h1>
                </div>
                <!-- Content Row -->
                <ul class="list-group mb-4">
                    @forelse($risets as $riset)
                    <li class="list-group-item">
                        <h4 class="mb-2"><a class="text-warning" href="{{$riset->url}}" target="_blank">{!!$riset->judul!!}</a></h4>
                        <p>{!!$riset->peneliti!!}</p>
                        <p>{{$riset->created_at}}</p>
                    </li>
                    @empty
                    <li class="list-group-item">
                        <h4 class="mb-2"><a class="text-danger text-center" href="#" target="_blank">Belum ada publikasi riset</a></h4>
                    </li>
                    @endforelse
                </ul>
            </div>
@endfragment
@endsection