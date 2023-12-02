@extends('layouts.header')
@section('content')
<!-- Begin Page Content -->
@fragment('users')
            <div class="container-fluid slide-it" id="app">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-dark">Users</h1>
                    <a href="{{route('register')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white fa-flip"></i> Add User</a>
                </div>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">List of Users</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" hx-history="false">
                            <table class="table table-borderless table-striped" id="userTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>SKPD</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{--@forelse ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}.</td>
                                        <td> {{$user->name}} </td>
                                        <td> {{$user->skpd->nama}} </td>
                                        <td> {{$user->email}} </td>
                                        <td>
                                            <div class="dropdown">
                                                @if ($user->status == 'active')
                                                <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                {{$user->status}}
                                                </button>
                                                @elseif ($user->status == 'inactive')
                                                <button class="btn btn-outline-danger btn-sm dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                {{$user->status}}
                                                </button>
                                                @endif
                                                @if ($user->status == 'inactive')
                                                <form method="POST" action="{{url('activate/'. $user->id)}}">
                                                    @csrf
                                                    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                                        <button class="dropdown-item">Activate</button>
                                                    </div>
                                                </form>
                                                @elseif ($user->status == 'active')
                                                <form method="POST" action="{{url('deactivate/'. $user->id)}}">
                                                    @csrf
                                                    <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                                        <button class="dropdown-item">Deactivate</button>
                                                    </div>
                                                </form>
                                                @endif
                                            </div>
                                        </td>       
                                    </tr>
                                    @empty
                                    <div class="alert alert-danger">
                                        Data  is not available.
                                    </div>
                                    @endforelse--}}
                                    @if(Session::has('success'))
                                    <div class="alert alert-success data-dismiss">
                                        {{ Session::get('success') }}
                                        @php
                                        Session::forget('success');
                                        @endphp
                                    </div>
                                    @elseif (Session::has('error'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('error') }}
                                        @php
                                        Session::forget('error');
                                        @endphp
                                    </div>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
<!-- /.container-fluid -->
        

{{--<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('vendor/selectize/selectize.min.js')}}"></script>
<script src="{{asset('vendor/stepper/stepper.min.js')}}"></script>
<script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>--}}
<x-logout/>
<script type="text/javascript">
    var dataTable = $('#userTable').DataTable({
        ajax: {
            url: '/api/users',
            dataSrc: 'data',
            processing: true,
            serverSide: true,
        },
        columns: [
            { 
                render: function (data, type, row, meta) {
                    return meta.row + 1 + '.';
                }
            },
            { 
                data: 'name' 
            },
            { 
                data: 'skpd.nama' 
            },
            { 
                data: 'email' 
            },
            {
             
                render: function (data, type, row) {
                    var status = row.status;
                    var statusClass = status == 'active' ? 'btn-outline-primary' : 'btn-outline-danger';

                    return `
                        <div class="dropdown">
                            <button class="btn btn-sm dropdown-toggle ${statusClass}" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                ${status}
                            </button>
                            <div class="dropdown-menu animated--fade-in">
                                <form method="POST" action="${status == 'inactive' ? '/activate/' : '/deactivate/'}${row.id}">
                                    @csrf
                                    <button class="dropdown-item">${status == 'inactive' ? 'Activate' : 'Deactivate'}</button>
                                </form>
                            </div>
                        </div>`;
                }
            },
        ],
        // other DataTable options...
    });
</script>
@endfragment
@endsection