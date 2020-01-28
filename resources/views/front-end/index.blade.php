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

  <title>Hefa Store</title>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="img/logo_small.png" alt="Hefa Store">
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
        <a href="" class="nav-link text-white"><i class="fas fa-shopping-cart"></i> My Cart (<span>12</span>)</a>
      </div>
    </div>
  </nav>
  <!-- Akhir Navbar -->


  <!-- Carousel -->
  <div id="carouselExampleControls" style="background-color: rgb(209, 219, 255);" class="carousel slide mt-5"
    data-ride="carousel">
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
              <div class="col-9 col-sm-4 col-md-6 col-lg-5">
                <h1 class="mb-4">{{$item->nama}}</h1>
                <p class="mb-4">{{$item->deskripsi}}</p>
                <a href="" class="btn btn-warning text-white">Get It Now</a>
              </div>
              <div class="col-3 col-sm-6 col-md-4 col-lg-4 d-none d-sm-block offset-1">
                <img src="/{{$item->foto}}" class="img-fluid">
              </div>
            </div>
          </div>
          @endforeach






        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
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
          <div class="col-6 col-sm-4 col-md-3 col-lg-2">
            <figure class="figure">
              <div class="figure-img">
                <img src="img/feature/3.png" class="figure-img img-fluid">
                <a href="" class="d-flex justify-content-center">
                  <img src="img/detail.png" class="align-self-center">
                </a>
              </div>
              <figcaption class="figure-caption text-center">
                <h5>Jeans Pubb</h5>
                <p>IDR 190.300</p>
              </figcaption>
            </figure>
          </div>
          <div class="col-6 col-sm-4 col-md-3 col-lg-2">
            <figure class="figure">
              <div class="figure-img">
                <img src="img/feature/1.png" class="figure-img img-fluid">
                <a href="" class="d-flex justify-content-center">
                  <img src="img/detail.png" class="align-self-center">
                </a>
              </div>
              <figcaption class="figure-caption text-center">
                <h5>Jeans Pubb</h5>
                <p>IDR 190.300</p>
              </figcaption>
            </figure>
          </div>
          <div class="col-6 col-sm-4 col-md-3 col-lg-2">
            <figure class="figure">
              <div class="figure-img">
                <img src="img/feature/2.png" class="figure-img img-fluid">
                <a href="" class="d-flex justify-content-center">
                  <img src="img/detail.png" class="align-self-center">
                </a>
              </div>
              <figcaption class="figure-caption text-center">
                <h5>Jeans Pubb</h5>
                <p>IDR 190.300</p>
              </figcaption>
            </figure>
          </div>
          <div class="col-6 col-sm-4 col-md-3 col-lg-2">
            <figure class="figure">
              <div class="figure-img">
                <img src="img/feature/3.png" class="figure-img img-fluid">
                <a href="" class="d-flex justify-content-center">
                  <img src="img/detail.png" class="align-self-center">
                </a>
              </div>
              <figcaption class="figure-caption text-center">
                <h5>Jeans Pubb</h5>
                <p>IDR 190.300</p>
              </figcaption>
            </figure>
          </div>
          <div class="col-6 col-sm-4 col-md-3 col-lg-2">
            <figure class="figure">
              <div class="figure-img">
                <img src="img/feature/1.png" class="figure-img img-fluid">
                <a href="" class="d-flex justify-content-center">
                  <img src="img/detail.png" class="align-self-center">
                </a>
              </div>
              <figcaption class="figure-caption text-center">
                <h5>Jeans Pubb</h5>
                <p>IDR 190.300</p>
              </figcaption>
            </figure>
          </div>
          <div class="col-6 col-sm-4 col-md-3 col-lg-2">
            <figure class="figure">
              <div class="figure-img">
                <img src="img/feature/2.png" class="figure-img img-fluid">
                <a href="" class="d-flex justify-content-center">
                  <img src="img/detail.png" class="align-self-center">
                </a>
              </div>
              <figcaption class="figure-caption text-center">
                <h5>Jeans Pubb</h5>
                <p>IDR 190.300</p>
              </figcaption>
            </figure>
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
              <img src="/img/social/twitter.png">
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
