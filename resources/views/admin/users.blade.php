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
                <!-- DataTales -->
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