<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/all.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Montserrat:200,400,600&display=swap"
        rel="stylesheet">

    <!-- My CSS -->
    <link rel="stylesheet" href="/css/style.css">

    <title>Pesantren Singosari</title>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
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
                    <!-- <li class="nav-item active">
            <a class="nav-link" href="#">Home</a>
          </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="#">Informasi Pondok</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Donasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Informasi</a>
                    </li>
                </ul>
                <a href="{{route('userlogin')}}" type="button" class="btn btn-sm btn-outline-info text-white">Masuk<i
                        class="fas fa-sign-in-alt"></i></a>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->


    <!-- Carousel -->
    <div id="carousel" style="background-color: rgb(209, 219, 255);" class="carousel slide mt-5" data-ride="carousel">
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
                            <div class="col-6 col-sm-4 col-md-6 col-lg-5">
                                <h1 class="mb-4">{{$item->nama}}</h1>
                                <p class="mb-4">{{$item->deskripsi}}</p>
                                <a href="" class="btn btn-warning text-white">Get It Now</a>
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-4 d-none d-sm-block offset-1">
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
            <!-- <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a> -->
        </div>
        <!-- Akhir Carousel -->

        <!-- Brands -->
        <section class="brands">
            <div class="container">
                <div class="row p-5 text-center">
                    <div class="col-md">
                        <img src="img/brand/cc.png" class="img-fluid">
                    </div>
                    <div class="col-md">
                        <img src="img/brand/nike.png" class="img-fluid">
                    </div>
                    <div class="col-md">
                        <img src="img/brand/pnb.png" class="img-fluid">
                    </div>
                    <div class="col-md">
                        <img src="img/brand/uniqlo.png" class="img-fluid">
                    </div>
                </div>
            </div>
        </section>
        <!-- Akhir Brands -->


        <!-- Features -->
        <section class="features bg-light p-5">
            <div class="container">
                <div class="row mb-3">
                    <div class="col">
                        <h3>Special Eid</h3>
                        <p>Promo pakaian cocok untuk lebaran</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card shadow mb-4 align-content-center">
                            <div class="card-header py-3 text-center">
                                <h6 class="m-0 font-weight-bold text-primary">Informasi Donasi</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 align-content-center justify-content-center">
                                        <div class="progress" style="height: 100px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                role="progressbar" style="width: 25%;" aria-valuenow="25"
                                                aria-valuemin="0" aria-valuemax="100">25%<br><strong
                                                    style="color: black">Nominal Terkumpul</strong></div>
                                        </div>
                                    </div>
                                    <div class=""></div>
                                    <div class="col-6">
                                        Info Donasi?????????
                                    </div>
                                </div>
                                <hr>
                                <div class="">
                                    <h5>Untuk donasi kirim kesini guys</h5>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>
        <!-- Akhir Features -->

        <!-- Designer -->
        <section class="designer p-5">
            <div class="container">
                <div class="row mb-3">
                    <div class="col">
                        <h3>Our Designers</h3>
                        <p>Pakaian terbaik dari designer profesional</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 col-sm-3 text-center">
                        <figure class="figure">
                            <img src="img/designer/1.png" class="figure-img img-fluid">
                            <figcaption class="figure-caption text-center">
                                <h5>Anne Mortgery</h5>
                                <p>Artistic Cloth</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="col-6 col-sm-3 text-center">
                        <figure class="figure">
                            <img src="img/designer/1.png" class="figure-img img-fluid">
                            <figcaption class="figure-caption text-center">
                                <h5>Anne Mortgery</h5>
                                <p>Artistic Cloth</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="col-6 col-sm-3 text-center">
                        <figure class="figure">
                            <img src="img/designer/1.png" class="figure-img img-fluid">
                            <figcaption class="figure-caption text-center">
                                <h5>Anne Mortgery</h5>
                                <p>Artistic Cloth</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="col-6 col-sm-3 text-center">
                        <figure class="figure">
                            <img src="img/designer/1.png" class="figure-img img-fluid">
                            <figcaption class="figure-caption text-center">
                                <h5>Anne Mortgery</h5>
                                <p>Artistic Cloth</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>

                <div class="row m-3">
                    <div class="col text-center">
                        <a href="">See All Our Designers</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Akhir Designer -->


        <!-- Footer -->
        <footer class="border-top p-5">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-1">
                        <a href="">
                            <img src="img/logo_small.png">
                        </a>
                    </div>
                    <div class="col-4 text-right">
                        <a href="">
                            <img src="img/social/fb.png">
                        </a>
                        <a href="">
                            <img src="/img/social/thttp://127.0.0.1:8000>tter.png">
                        </a>
                        <a href="">
                            <img src="/img/social/ig.png">
                        </a>
                    </div>
                </div>
                <div class="row mt-3 justify-content-between">
                    <div class="col-5">
                        <p>All Rights Reserved by Hefa Store Copyright 2019.</p>
                    </div>
                    <div class="col-6">
                        <nav class="nav justify-content-end text-uppercase">
                            <a class="nav-link active" href="#">Jobs</a>
                            <a class="nav-link" href="#">Developer</a>
                            <a class="nav-link" href="#">Terms</a>
                            <a class="nav-link pr-0" href="#">Privacy Policy</a>
                        </nav>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Akhir Footer -->






        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="/js/jquery-3.4.1.min.js"></script>
        <script src="/js/popper.min.js"></script>
        <script src="/js/bootstrap.js"></script>
        <script src="/js/all.js"></script>
</body>

</html>
