<footer class="footer text-center">
    {{--<div class="container">
        <div class="row">
            <!-- Footer Location-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Location</h4>
                @foreach ($settings as $s)
                <p class="lead mb-0">
                    {{$s->alamat}}
                </p>
                @endforeach
            </div>
            <!-- Footer Social Icons-->
            <div class="col-lg-4 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Around the Web</h4>
                <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-twitter"></i></a>
                <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-instagram"></i></a>
            </div>
            <!-- Footer About Text-->
            <div class="col-lg-4">
                <h4 class="text-uppercase mb-4">Visit Us</h4>
                <p class="lead mb-0">
                    Kunjungi situs Badan Perencanaan, Penelitian, dan Pengembangan Daerah
                    <a href="#">disini</a>
                    .
                </p>
            </div>
        </div>
    </div>--}}
    <img alt="logo-1" class="footer_logo" src="{{asset('assets/tias.png')}}">
    <img src="{{asset('assets/bottom_img2.png')}}" class="d-block img-fluid mx-auto" alt="footer-img">
</footer>
<div class="copyright py-4 text-center text-white">
    <div class="container"><small>Copyright &copy; Bappedalitbang Tanah Bumbu 2023 - {{ now()->year }}</small></div>
</div>