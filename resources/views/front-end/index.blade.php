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

    <<<<<<< HEAD <title>Pondok Pesantren Negeri Akhirat</title>
        =======
        <title>Pesantren Singosari</title>
        >>>>>>> db904bd9ed3a7b1cc97491c758550224f13994dc
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
    <div id="carousel" style="background-color: rgb(209, 219, 255);" class="carousel slide mt-4" data-ride="carousel">
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
          </div>
        <!-- Akhir Carousel -->

        <!-- Donasi -->
        <section class="features bg-light p-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card shadow mb-4 align-content-center">
                            <div class="card-header py-3 text-center">
                                <h6 class="m-0 font-weight-bold text-primary">Informasi Donasi</h6>
                            </div>
                            <div class="card-body" style="height: 700px;">
                                <div class="row" style="height: 90%;">
                                    <div class="col-6 align-content-center justify-content-center">
                                        
                                    </div>
                                    <div class="col-2">

                                    </div>
                                    <div class="col-4">
                                      <div class="row ml-5 ">Donasi Yang Diperlukan <p><br></p></div>
                                    <div class="row ml-5"><strong>Rp.</strong>{{\App\donasi::first()->Target}} <p><br></p></div>
                                      <div class="progress" style="height: 70px;">
                                        <?php
                                          $i = \App\donasi::first()->Target;
                                          $j = \App\donasi_masuk::get()->pluck('nominal');
                                          $total = 0;
                                          for($a = 0; $a < count($j); $a++){
                                            $total += $j[$a];
                                          }

                                          $persen = $total / $i *100;
                                        ?>
                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                            role="progressbar" style="width: {{$persen}}%;" aria-valuenow="{{$persen}}"
                                        aria-valuemin="0" aria-valuemax="100">{{$persen}} %<br></div>
                                    </div>
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
        <!-- Akhir Donasi -->

{{-- Alamat--}}
<section class="features bg-secondary p-5">
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
</section>

{{-- Akhir Alamat --}}

        <!-- Footer -->
        <footer class="border-top p-5">
        
            <div class="container">
            <!-- <i class="fas fa-mosque"></i> -->
                <div class="row justify-content-between">
                    <div class="col-1">
                       
                        <i class="fas fa-mosque"></i>
                       
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
