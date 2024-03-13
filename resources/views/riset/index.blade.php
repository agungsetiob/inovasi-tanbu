@extends('layouts.riset-menus')
@section('content')
    @fragment('dashboard')
        <div class="container-fluid slide-it" id="app" hx-history="false">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-dark">Dashboard Riset</h1>
            </div>
            <ul class="list-group mb-4">
                @forelse($risets as $riset)
                    <li class="list-group-item bg-gradient-light">
                        <h4><a class="text-warning" href="{{$riset->url}}" target="_blank">{!!$riset->judul!!}</a></h4>
                        <p>{!!$riset->peneliti!!}</p>
                        <p class="float-right">{{$riset->created_at}}</p>
                    </li>
                @empty
                    <li class="list-group-item text-center">
                        <a class="text-danger h5" href="#">Belum ada publikasi riset</a>
                    </li>
                @endforelse
            </ul>
            <div class="d-flex justify-content-center">
                {{ $risets->links('pagination::simple-bootstrap-4') }}
            </div>
        </div>
    @endfragment
@endsection
