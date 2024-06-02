@if(Session::has('success'))
    <div class="alert alert-success data-dismiss alert-dismissible">
        <i class="fa fa-solid fa-check"></i>
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
        <i class="fa fa-solid fa-bell fa-shake"></i>
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif