<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="/css/sb-admin-2.min.css" rel="stylesheet"> --}}
    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="/css/bootstrap.css"> --}}

    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="/css/all.css"> --}}

    <!-- Google Font -->

    {{-- <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet"> --}}

    <!-- My CSS -->
    {{-- <link rel="stylesheet" href="/css/style.css"> --}}

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        /* Make the image fully responsive */
        .carousel-inner img {
            width: 100%;
            height: 100%;
        }
    </style>
    <title>Pondok Pesantren Negeri Akhirat</title>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #4281A7">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-mosque"></i>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav text-uppercase mx-auto">
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Akademik</a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link" href="#pengumuman">Pengumuman</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#donasi">Donasi</a>
                    </li> --}}
                </ul>
                <a href="{{route('userlogin')}}" type="button" class="btn btn-sm btn-outline-info text-white"
                    style="border-style: none;">LOGIN<i class=""></i></a>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->


    {{-- Side Bar --}}
    <div class="row pt-10">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                <span class="badge badge-secondary badge-pill">3</span>
            </h4>
            <ul class="list-group mb-3">
                @foreach (\App\pengumuman::get()->take(10) as $p)
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    {{$pengumuman->judul}}
                </li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <div class="row">
                <h3>{{$pengumuman->judul}}</h3>
            </div>
            <div class="row">
                <code>{{$pengumuman->dibuat}}</code>
            </div>
            <div class="row" style="height: 250px; padding: 100px">
                <img class="img-fluid" src="/{{$pengumuman->foto}}">
            </div>
            <div class="row">
                <p>{{$pengumuman->deskripsi}}</p>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5">
        <div class="row mt-10">
            <div class="col-8">

            </div>
            <div class="col-4">
                <div>
                   
                </div>
            </div>
        </div>
    </div>

    {{-- Akhir Side Bar --}}

    <!-- Footer -->
    <div class="pt-5 pb-5 footer" style="background-color: #4281A7">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-xs-12 about-company">
                    <h2 class="font-weight-bold">Negeri Akhirat</h2>
                    <p class="pr-5 text-white-50">Disini isi deskripsi singkat tentang Pondok </p>
                    <p><a href="#"><i class="fa fa-facebook-square mr-1"></i></a><a href="#"><i
                                class="fa fa-linkedin-square"></i></a></p>
                </div>
                <div class="col-lg-3 col-xs-12 links">
                    <h4 class="mt-lg-0 mt-sm-3">Links</h4>
                    <ul class="m-0 p-0">
                        {{-- <li><a href="#">Profil</a></li>
                            <li><a href="#">Akademik</a></li> --}}
                        <li><a href="#pengumuman">Pengumuman</a></li>
                        <li><a href="#donasi">Donasi</a></li>

                    </ul>
                </div>
                <div class="col-lg-4 col-xs-12 location">
                    <h4 class="mt-lg-0 mt-sm-4">Location</h4>
                    <p>Jl. Sempit, Biru, Gunungrejo, Kec. Singosari, Malang, Jawa Timur 65153</p>
                    <p class="mb-0"><i class="fa fa-phone mr-3"></i>(541) 754-3010</p>
                    <p><i class="fa fa-envelope-o mr-3"></i>info@hsdf.com</p>
                </div>
            </div>
            {{-- <div class="row mt-5">
                        <div class="col copyright">
                            <p class=""><small class="text-white-50">© 2019. All Rights Reserved.</small></p>
                        </div>
                    </div> --}}
        </div>
    </div>

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href="#"> </a>
    </div>
    <!-- Copyright -->

    </footer>
    <!-- Footer -->
    <!-- Akhir Footer -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/js/jquery-3.4.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/all.js"></script>
    <script>
        $(document).ready(function(){
                // Add scrollspy to <body>
                $('body').scrollspy({target: ".navbar"});

                // Add smooth scrolling on all links inside the navbar
                $("#navbarNav a").on('click', function(event) {
                    // Make sure this.hash has a value before overriding default behavior
                    if (this.hash !== "") {
                    // Prevent default anchor click behavior
                    event.preventDefault();

                    // Store hash
                    var hash = this.hash;

                    // Using jQuery's animate() method to add smooth page scroll
                    // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function(){

                        // Add hash (#) to URL when done scrolling (default click behavior)
                        window.location.hash = hash;
                    });
                    }  // End if
                });
                });
    </script>
</body>

</html>