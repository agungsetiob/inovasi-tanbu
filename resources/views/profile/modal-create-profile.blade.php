<div class="modal fade" id="createProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('profile/create') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Pemda</label>
                        <input type="text" class="form-control" name="nama" id="nama" required>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                        <label for="skpd">SKPD Pengampu</label>
                        <input type="text" class="form-control" name="skpd" id="skpd" required>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-skpd"></div>
                        <label for="alamat">Alamat Pemda</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" required>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat"></div>
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email"></div>
                        <label for="telp">Telpon</label>
                        <input type="text" class="form-control" name="telp" id="telp" required>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-telp"></div>
                        <label for="admin">Nama Admin</label>
                        <input type="text" class="form-control" name="admin" id="admin" required>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-admin"></div>
                    </div>
                    <button id="store" type="submit" class="btn btn-primary">Save</button>
                </form>
            </div> 
        </div>
    </div>
</div>