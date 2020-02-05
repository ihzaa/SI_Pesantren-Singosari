<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/all.css">

    <!-- Google Font -->

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- My CSS -->
    <link rel="stylesheet" href="/css/style.css">

    <<<<<<< HEAD <title>Pondok Pesantren Negeri Akhirat</title>
        =======
        <title>Pesantren Singosari</title>
        >>>>>>> db904bd9ed3a7b1cc97491c758550224f13994dc
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
                    <li class="nav-item">
                        <a class="nav-link" href="#">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Akademik</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pengumuman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Donasi</a>
                    </li>
                </ul>
                <a href="{{route('userlogin')}}" type="button" class="btn btn-sm btn-outline-info text-white"
                    style="border-style: none;">LOGIN<i class=""></i></a>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->


    <!-- Carousel -->
    <div id="carousel" style="background-color: rgb(68, 160, 215);" class="carousel slide mt-4" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            $cnt = count(\App\carousel::where('status','aktif')->get());
            $j = 0;
            ?>
            @while($j < $cnt) @if($j==0) <li data-target="#carousel" data-slide-to="{{$j++}}" class="active">
                </li>
                @else
                <li data-target="#carousel" data-slide-to="{{$j++}}"></li>
                @endif
                @endwhile
        </ol>
        <div class="carousel-inner">
            <div class="container">
                <?php
                    $i=0;
        ?>
                @foreach (\App\carousel::where('status','aktif')->get() as $item)
                @if($i == 0)
                <div class="carousel-item active">
                    <?php
                        $i=1;
                    ?>
                    @else
                    <div class="carousel-item">
                        @endif
                        <div class="row pt-5 justify-content-center">
                            <div class="col-6 col-sm-4 col-md-6 col-lg-5 col-xs-6">
                                <h1 class="mb-4">{{$item->nama}}</h1>
                                <p class="mb-4">{{$item->deskripsi}}</p>
                                {{-- <a href="" class="btn btn-warning text-white">Get It Now</a> --}}
                            </div>
                            {{-- d-none d-sm-block --}}
                            <div class="col-6 col-sm-6 col-md-4 col-lg-4 col-xs-6  offset-1">
                                <img src="/{{$item->foto}}" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="#carousel" class="carousel-control-prev" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>

                <a href="#carousel" class="carousel-control-next" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
        <!-- Akhir Carousel -->

        {{-- Pengumuman --}}
        <div class="container-fluid">
            {{-- #428bca --}}
            <div class="row justify-content-center" style="background-color: #4281A7;">
                @foreach(\App\pengumuman::get()->take(4) as $p)
                <div class="col-3 mt-4 ">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">{{$p->judul}}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col ">
                                    <img src="{{$p->foto}}" alt="image" class="img-fluid">

                                </div>
                                
                            </div>
                            <p class="text-lg mb-0">{{$p->isi}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- <div class="col-3 mt-4 ">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Custom Font Size Utilities</h6>
                        </div>
                        <div class="card-body">
                            <p class="text-xs">.text-xs</p>
                            <p class="text-lg mb-0">.text-lg</p>
                        </div>
                    </div>
                </div> --}}
                {{-- <div class="col-3 mt-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Custom Font Size Utilities</h6>
                        </div>
                        <div class="card-body">
                            <p class="text-xs">.text-xs</p>
                            <p class="text-lg mb-0">.text-lg</p>
                        </div>
                    </div>
                </div>
                <div class="col-3 mt-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Custom Font Size Utilities</h6>
                        </div>
                        <div class="card-body">
                            <p class="text-xs">.text-xs</p>
                            <p class="text-lg mb-0">.text-lg</p>
                        </div>
                    </div>
                </div>
                <div class="col-3 mt-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Custom Font Size Utilities</h6>
                        </div>
                        <div class="card-body">
                            <p class="text-xs">.text-xs</p>
                            <p class="text-lg mb-0">.text-lg</p>
                        </div>
                    </div>
                </div> --}}

            </div>
        </div>
        <!-- Donasi -->
        <section class="features p-5" style="background-color: #4192C2">
            <div class="container-fluid">
                <div class="row" style="">
                    <div class="col-xl-12">
                        <div class="card shadow mb-4 align-content-center">
                            <div class="card-header py-3 text-center">
                                <h6 class="m-0 font-weight-bold text-primary">Informasi Donasi</h6>
                            </div>
                            <div class="card-body">
                                <?php
                                    $i = \App\donasi::first();
                                ?>
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                        <div class="row ml-2 justify-content-center">
                                            {{$i->judul}}

                                        </div>
                                        <div class="row ml-2 mr-2">
                                            {{$i->deskripsi}}
                                        </div>
                                        <div class="row mt-4 justify-content-center text-center align-content-center">
                                            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                                <img src="{{$i->foto}}" class="img-fluid" alt="Gambar apa gitu">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-sm-12 border-left-secondary">
                                        <div class="row ml-2 ">Donasi Yang Diperlukan <p><br></p>
                                        </div>
                                        <?php
                                                $i = \App\donasi::first()->Target;
                                                $i_arr = str_split(strrev($i),3);
                                                $tlt = "";
                                                for($a = 0; $a < count($i_arr);$a++){
                                                    if($a == (count($i_arr)-1)){
                                                        $tlt = $tlt .''. $i_arr[$a];
                                                        continue;
                                                    }
                                                    $tlt = $tlt .''. $i_arr[$a].'.';
                                                }
                                                // implode($tlt);
                                                $tlt = strrev($tlt);
                                            ?>
                                        <div class="row ml-2">
                                            <h3><strong>Rp. {{$tlt}}</strong></h3>
                                            <p><br><br></p>
                                        </div>
                                        <div class="progress" style="height: 70px;">
                                            <?php
                                                $j = \App\donasi_masuk::get()->pluck('nominal');
                                                $total = 0;
                                                for($a = 0; $a < count($j); $a++){
                                                $total += $j[$a];
                                            }
                                              $persen = $total / $i *100;
                                            ?>
                                            <div class="progress-bar progress-bar-striped progress-bar-animated "
                                                role="progressbar" style="width: {{$persen}}%;"
                                                aria-valuenow="{{$persen}}" aria-valuemin="0" aria-valuemax="100">
                                                <h4> {{$persen}} %</h4>
                                            </div>
                                        </div>
                                        <div class="row mt-2 text-center align-content-center justify-content-center">
                                            <p><br></p>
                                            Donasi yang terkumpul
                                        </div>
                                        <div class="row mt-2 text-center align-content-center justify-content-center">


                                            @foreach (\App\donasi_masuk::orderBy('dibuat','desc')->take(3)->get() as
                                            $item)
                                            {{ucfirst($item->nama)}} - Rp. {{$item->nominal}}<br>
                                            @endforeach

                                        </div>

                                    </div>
                                </div>
                                <hr>
                                <div class="">
                                    <h5></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Akhir Donasi -->

        {{-- Alamat--}}
        {{-- <section class="features bg-secondary p-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card shadow mb-4 align-content-center">
                            <div class="card-header py-3 text-center">
                                <h6 class="m-0 font-weight-bold text-primary">Alamat</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 align-content-center justify-content-center">
                                        <div class="progress" style="height: 100px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                role="progressbar" style="width: 25%;" aria-valuenow="25"
                                                aria-valuemin="0" aria-valuemax="100">25%<br></div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        {{-- Akhir Alamat --}}

        <!-- Footer -->
        <div class="mt-5 pt-5 pb-5 footer bg-secondary">
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
                            <li><a href="#">Profil</a></li>
                            <li><a href="#">Akademik</a></li>
                            <li><a href="#">Pengumuman</a></li>
                            <li><a href="#">Donasi</a></li>

                        </ul>
                    </div>
                    <div class="col-lg-4 col-xs-12 location">
                        <h4 class="mt-lg-0 mt-sm-4">Location</h4>
                        <p>Jl. Sempit, Biru, Gunungrejo, Kec. Singosari, Malang, Jawa Timur 65153</p>
                        <p class="mb-0"><i class="fa fa-phone mr-3"></i>(541) 754-3010</p>
                        <p><i class="fa fa-envelope-o mr-3"></i>info@hsdf.com</p>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col copyright">
                        <p class=""><small class="text-white-50">© 2019. All Rights Reserved.</small></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© 2020 Copyright:
            <a href="https://mdbootstrap.com/education/bootstrap/"> MDBootstrap.com</a>
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
</body>

</html>