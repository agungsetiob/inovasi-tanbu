<!-- UI for jenis inovasi -->
@extends('layouts.header')
@section('content')
<!-- Begin Page Content -->
@fragment('jenis')
    <div class="container-fluid slide-it" id="app" data-loading-class="d-none">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-dark">Jenis Inovasi</h1>
            <a href="#" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addCategory"><i class="fas fa-plus fa-sm text-white fa-flip"></i> Tambah Jenis</a>
        </div>
        <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Jenis Inovasi</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless table-striped text-dark" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Dibuat pada</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $cat)
                                <tr id="index_{{$cat->id}}">
                                    <td>{{ $loop->iteration }}.</td>
                                    <td> {{$cat->name}} </td>
                                    <td> {{$cat->created_at}} </td>
                                    <td>
                                        <button class="btn btn-outline-danger btn-sm delete-button" title="hapus" 
                                        data-toggle="modal" 
                                        data-target="#deleteModal" 
                                        data-jenis-id="{{ $cat->id }}"
                                        data-jenis-name="{{ $cat->name }}"><i class="fas fa-trash"></i></button>
                                        <div class="dropdown mb-4 d-inline">
                                            <button
                                            class="btn btn-outline-primary dropdown-toggle btn-sm"
                                            type="button"
                                            id="dropdownMenuButton"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                            data-jenis-id="{{ $cat->id }}"
                                            data-jenis-status="{{ $cat->status }}">
                                            {{ $cat->status }}
                                            </button>
                                            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                                <button class="dropdown-item toggle-status-button" data-action="toggle-status">Change Status</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data  is not available.
                                </div>
                                @endforelse
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
                                <div id="success-alert" class="alert alert-success alert-dismissible fade show d-none" role="alert">
                                    <span id="success-message"></span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<!-- /.container-fluid -->
    
<!-- Add Modal -->
<div class="modal fade" id="addCategory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah jenis inovasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('jenis.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Jenis inovasi</label>
                        <input type="text" name="name" class="form-control" id="name" required placeholder="Masukkan jenis inovasi">   
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div> 
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('js/sb-admin-2.min.js')}}"></script>
<script src="{{asset('vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('vendor/selectize/selectize.min.js')}}"></script>
<script src="{{asset('vendor/stepper/stepper.min.js')}}"></script>
<script src="{{asset('vendor/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>
<x-logout/>
@include ('components.modal-delete-category')
<script type="text/javascript">
    $(document).ready(function() {
        $(".toggle-status-button").click(function() {
            var button = $(this);
            var jenisId = button.closest('.dropdown').find('.dropdown-toggle').data('jenis-id');
            var currentStatus = button.closest('.dropdown').find('.dropdown-toggle').data('jenis-status');

            $.ajax({
                url: '/jenis/change-status/' + jenisId,
                type: 'PUT',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(response) {
                    if (response.success) {
                        var newStatus = response.newStatus;
                        button.closest('.dropdown').find('.dropdown-toggle').data('jenis-status', newStatus);
                        button.closest('.dropdown').find('.dropdown-toggle').text(newStatus);
                        $('#success-alert').removeClass('d-none').addClass('show');
                        $('#success-message').text(response.message);
                        $('#error-alert').addClass('d-none');
                        setTimeout(function() {
                            $('#success-alert').addClass('d-none').removeClass('show');
                        }, 3700);
                    }
                },
                error: function(response) {
                    $('#error-message').text('Error gagal merubah status');
                    $('#error-alert').removeClass('d-none').addClass('show');
                }
            });
        });
    });
</script>
@endfragment
@endsection