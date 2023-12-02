@extends ('layouts.header')
@section ('content')
@fragment ('carousel')
<style type="text/css">
	#upload {
    opacity: 0;
	}

	#upload-label {
	    position: absolute;
	    top: 50%;
	    left: 1rem;
	    transform: translateY(-50%);
	}

	.image-area {
	    border: 2px dashed rgb(118 124 144 / 0.7);
	    padding: 1rem;
	    position: relative;
	}

	.image-area::before {
	    content: 'Uploaded image result';
	    font-weight: bold;
	    text-transform: uppercase;
	    position: absolute;
	    top: 50%;
	    left: 50%;
	    transform: translate(-50%, -50%);
	    font-size: 0.8rem;
	    z-index: 1;
	}

	.image-area img {
	    z-index: 2;
	    position: relative;
	}
</style>
		<div class="container-fluid py-5 slide-it" id="app">
			<header class="text-white text-center">
		        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/Picture_icon_BLACK.svg" alt="" width="150" class="mb-4">
		    </header>
		    <div class="row py-4">
		        <div class="col-lg-6 mx-auto">
		        	@if(Session::has('success'))
			        	<div class="alert alert-success data-dismiss alert-dismissible">
			        		{{ Session::get('success') }}
			        		@php
			        		Session::forget('success');
			        		@endphp
			        		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			        			<span aria-hidden="true">&times;</span>
			        		</button>
			        	</div>
		        	@endif
		        	@if ($errors->any())
					    <div class="alert alert-danger data-dismiss alert-dismissible">
					        @foreach ($errors->all() as $error)
					        	{{ $error }}
					        @endforeach
					        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			        			<span aria-hidden="true">&times;</span>
			        		</button>
					    </div>
					@endif
		        	<form method="POST" 
		        	hx-post="{{ url('carousel/upload') }}" 
		        	hx-target="#app" 
		        	hx-swap="outerHTML transition:true" 
		        	hx-indicator="#loadingIndicator"
		        	hx-history="false"
		        	hx-encoding="multipart/form-data">
		        		@csrf
			            <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
			                <input id="upload" accept=".jpg,.png,.jpeg" name="image" type="file" onchange="readURL(this);" class="form-control border-0">
			                <label id="upload-label" for="upload" class="font-weight-light text-muted">Choose file</label>
			                <div class="input-group-append">
			                    <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label>
			                </div>
			            </div>
			            <div class="image-area mt-4">
			            	<img id="imageResult" src="#" alt="" class="img-fluid w-50 rounded shadow-sm mx-auto d-block">
			            </div>
			            <button type="submit" class="btn btn-primary mt-3 w-100">Upload carousel image</button>
			        </form>
		        </div>
		    </div>
		    <div class="row">
		        @foreach ($carousels as $carousel)
		        <div id="index_{{$carousel->id}}" class="col-lg-4 mb-3">
		        	<div class="image-thumbnail overflow-hidden" style="max-height: 300px;">
		        		<img src="{{url('storage/carousels/' . $carousel->image)}}" class="img-fluid w-100" alt="carousel">
		        	</div>
		        	<button class="btn btn-outline-danger w-100 mt-2 delete-button" data-id="{{$carousel->id}}">Hapus</button>
		        </div>
		        @endforeach
		    </div>
		</div>
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

{{--delete modal--}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Tekan tombol hapus apabila anda sudah yakin.</div>
        <div id="success-alert" class="modal-body d-none"><span id="success-message" class="text-success"></span></div>
        <div id="error-alert" class="modal-body d-none"><span id="error-message" class="text-danger"></span></div>
        <div class="modal-footer">
            <button class="btn btn-outline-secondary" type="button" data-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancel</button>
            <button id="delete-carousel" class="btn btn-outline-danger" title="kirim"><i class="fa-solid fa-trash"></i> Hapus</button>
        </div>
    </div>
</div>
</div>
<script>
    $(document).ready(function() {
        var id;

        $(".delete-button").click(function() {
            id = $(this).data("id");
            $('#deleteModal').modal('show');
        });

        $("#delete-carousel").click(function() {
            $.ajax({
                url: '/carousel/' + id,
                type: 'DELETE',
                headers: { 
                	'X-CSRF-TOKEN': "{{ csrf_token() }}" 
            	},
                success: function(response) {
                    if (response.success) {
                        $('#success-alert').removeClass('d-none');
                        $('#success-message').text(response.message);
                        $('#index_' + id).remove();
                        setTimeout(function() {
                            $('#deleteModal').modal('hide');
                        }, 3700);
                    }
                },
                error: function(response) {
                    $('#error-message').text('Gagal menghapus gambar');
                    $('#error-alert').removeClass('d-none');
                    console.error(error);
                }
            });
        });
    });

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#imageResult')
				.attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}

	$(function () {
		$('#upload').on('change', function () {
			readURL(input);
		});
	});

	var input = document.getElementById( 'upload' );
	var infoArea = document.getElementById( 'upload-label' );

	input.addEventListener( 'change', showFileName );
	function showFileName( event ) {
		var input = event.srcElement;
		var fileName = input.files[0].name;
		infoArea.textContent = fileName;
	}
</script>
@endfragment
@endsection