<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel='icon' href='/img/logo.png' type='image/x-icon' style="height: 25px;">
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

        .hideme {
            opacity: 0;
        }


        @media screen and (min-width: 576px) {
            .box-wrap {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .box {
                transition: .2s all;
            }

            .box-wrap:hover .box {
                filter: blur(0.3px);
                opacity: 1;
                transform: scale(.90);
                box-shadow: none;
            }

            .box-wrap:hover .box:hover {
                z-index: 10;
                transform: scale(1.05);
                filter: blur(0px);
                opacity: 1;
                /*box-shadow: 0 8px 20px 0px rgba(0, 0, 0, 0.125);*/
            }
        }

        @media screen and (min-width: 992px) {
            body {
                padding-top: 18px;
            }
        }

        @media screen and (max-width: 767px) {
            #kolomkanandonasi {
                margin-top: 20px;
            }
        }

        @media screen and (max-width: 991px) {
            body {
                padding-top: 66px;
            }
        }
    </style>
    <title>Pondok Pesantren Negeri Akhirat</title>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top"
        style="background : linear-gradient(to right, #1c648f 30%, #4281a7 89%);">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img class="img-fluid" src="/img/logo.png" alt="" style="height: 45px;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav text-uppercase mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#pengumuman">Informasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#donasi">Donasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#artikel">Artikel</a>
                    </li>
                </ul>
                <div>
                    <a href="{{route('userlogin')}}" type="button" class="btn btn-sm btn-outline-info text-white"
                        style="border-style: none;">LOGIN<i class=""></i></a>
                    <i class="far fa-window-minimize fa-rotate-90 ml-2"></i>
                    <a href="{{route('liatDev')}}" class="btn btn-sm btn-outline-info text-light"
                        style="border-style: none;"><i class="fas fa-code mr-2"></i>Dev</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->


    <!-- Carousel -->

    <div id="demo" class="carousel slide mt-lg-5" data-ride="carousel">

        <!-- Indicators -->
        <ul class="carousel-indicators">
            <?php
            $cnt = count(\App\carousel::where('status','aktif')->get());
            $j = 0;
            ?>
            @while($j < $cnt) @if($j==0) <li data-target="#demo" data-slide-to="{{$j++}}" class="active">
                </li>
                @else
                <li data-target="#demo" data-slide-to="{{$j++}}"></li>
                @endif
                @endwhile
        </ul>

        <!-- The slideshow -->
        <div class="carousel-inner">
            <?php
                $i=0;
            ?>

            @foreach (\App\carousel::where('status','aktif')->get() as $item)
            @if($i == 0)
            <div class="carousel-item active">
                @else
                <div class="carousel-item">
                    @endif
                    <img src="/{{$item->foto}}" alt="Foto{{$i++}}" class="d-block w-100">
                    @if($item->deskripsi != NULL)
                    <div class="carousel-caption">
                        <h3>{{$item->nama}}</h3>
                        <p>{{$item->deskripsi}}</p>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
    <!-- Akhir Carousel -->

    {{-- Pengumuman --}}
    <div id="pengumuman" class="container-fluid text-center pt-4 pb-4" style="background-color: #4281A7;">
        {{-- #428bca --}}
        <div id="kotakpengumuman">
            <h2 style="color: aliceblue"> INFORMASI </h2>
            <div class="row justify-content-center box-wrap" style="background-color: #4281A7;">
                <?php
                        $last_id = 0;
                    ?>
                @foreach(\App\pengumuman::where('prioritas','y')->get() as $p)


                <div class="col-xl-3 col-md-3 col-sm-12 col-xs-12 mt-4 hideme box">
                    <a href="/informasi/{{$p->id}}/{{$p->judul}}">
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
                                <?php
                                    $str = preg_replace('/(<i>)|(<\/i>)|(<strong>)|(<\/strong>)|(<br>)|(<hr>)|(<u>)|(<\/u>)/', '', str_limit($p->isi,80));
                                    echo '<p class="text-lg mb-0 text-dark">'.$str."</p>";
                                ?>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            {{ csrf_field() }}
            <div id="load_more">
                <button type="button" name="load_more_button" class="btn btn-outline-light"
                    data-id="{{\App\pengumuman::where('prioritas','n')->orderBy('id','DESC')->pluck('id')->first()}}"
                    id="load_more_button">Lihat Lainnya</button>
            </div>
        </div>
    </div>
    <!-- Donasi -->
    <section id="donasi" class="features p-1 pt-4" style="background-color: #4192C2">
        <div class="container-fluid">
            <div class="row" style="">
                <div class="col-xl-12">
                    <div class="card shadow mb-4 align-content-center">
                        <div class="card-header py-3 text-center">
                            <h3 class="m-0 font-weight-bold text-primary">DONASI</h3>
                        </div>
                        <div class="card-body mx-2">
                            <div class="tab-content">
                                <?php
                                    $i = \App\donasi::first();
                                ?>
                                {{-- DONASI OPERASIONAL --}}
                                <div class="tab-pane active" role="tabpanel" id="donasi1">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                            <div class="row justify-content-center">
                                                {{$i->judul}}

                                            </div>
                                            <div class="row mr-2">
                                                {{$i->deskripsi}}
                                            </div>
                                            <div
                                                class="row mt-4 justify-content-center text-center align-content-center">
                                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                                    <img src="{{$i->foto}}" class="img-fluid" alt="Gambar apa gitu">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="kolomkanandonasi"
                                            class="col-lg-4 col-md-4 col-sm-12 col-sm-12 border-left-secondary shadow">
                                            <div class="row text-center align-content-center justify-content-center">
                                                Donasi Yang Diperlukan <p><br></p>
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
                                            <div class="row text-center align-content-center justify-content-center">
                                                <h3><strong>Rp. {{$tlt}}</strong></h3>
                                                <p><br><br></p>
                                            </div>
                                            <div class="progress d-flex justify-content-center" style="height: 70px;">
                                                <?php
                                                    $j = \App\donasi_masuk::get()->pluck('nominal');
                                                    $total = 0;
                                                    for($a = 0; $a < count($j); $a++){
                                                    $total += $j[$a];
                                                    }
                                                  $persen = $total / $i *100;
                                                ?>
                                                <div class="progress-bar progress-bar-striped progress-bar-animated mr-auto"
                                                    role="progressbar" style="width: {{$persen}}%;"
                                                    aria-valuenow="{{$persen}}" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                                <h4 class="mt-3" style="color: black;position: absolute;">
                                                    {{round($persen)}} %</h4>
                                            </div>
                                            <div
                                                class="row mt-2 text-center align-content-center justify-content-center">
                                                <p><br></p>
                                                Donasi yang terkumpul
                                            </div>
                                            <div
                                                class="row mt-2 text-center align-content-center justify-content-center">



                                                @foreach(\App\donasi_masuk::orderBy('dibuat','desc')->take(3)->get()
                                                as
                                                $item)
                                                <?php
                                                        $i = $item->nominal;
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

                                                {{ucfirst($item->nama)}} - Rp. {{$tlt}} -
                                                {{Carbon\Carbon::parse($item->dibuat)->diffForHumans()}}<br>
                                                @endforeach

                                            </div>

                                        </div>
                                    </div>
                                </div>


                                {{-- DONASI PEMBANGUNAN --}}
                                <div class="tab-pane" role="tabpanel" id="donasi2">
                                    <div class=" row">
                                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                            <div class="row ml-2 justify-content-center">
                                                INI JUDUL

                                            </div>
                                            <div class="row ml-2 mr-2">
                                                IYA DESKRIPSI
                                            </div>
                                            <div
                                                class="row mt-4 justify-content-center text-center align-content-center">
                                                <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                                    <img src="" class="img-fluid" alt="Gambar apa gitu">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-sm-12 border-left-secondary">
                                            <div class="row ml-2 ">Donasi Yang Diperlukan <p><br></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="">
                            <h5>
                                {{-- TAB DONASI --}}
                                <ul class="nav nav-pills justify-content-center" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#donasi1"
                                            role="tab" aria-selected="true">Operasional</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#donasi2"
                                            role="tab" aria-selected="false">Pembangunan</a>
                                    </li>
                                </ul>

                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Akhir Donasi -->
    </section>

    {{-- Artikel --}}
    <div id="artikel" class="container-fluid text-center pt-4 pb-4" style="background-color: #4281A7;">
        {{-- #428bca --}}
        <div id="kotakartikel">
            <h2 style="color: aliceblue"> ARTIKEL </h2>
            <div class="row justify-content-center box-wrap" style="background-color: #4281A7;">
                <?php
                    $lastid = 0;
                ?>
                @foreach(\App\artikel::take(4)->get() as $p)
                <div class="col-xl-3 col-md-3 col-sm-12 col-xs-12 mt-4 hideme box">
                    <a href="/lihat/artikel/{{$p->id}}">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">

                                <h6 class="m-0 font-weight-bold text-primary">{{$p->nama}}</h6>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col ">
                                        <?php
                                    echo '<p class="mb-0 text-dark">'.strip_tags(html_entity_decode(str_limit($p->content,80)))."</p>";
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
                    $last_id = $p->id;
                ?>
                @endforeach
            </div>
            {{ csrf_field() }}
            <div id="load_more_artikel">
                <button type="button" name="load_more_button" class="btn btn-outline-light" data-id="{{$last_id}}"
                    id="load_more_button_artikel">Lihat Lainnya</button>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <div class="pt-5 pb-5 footer" style="background :linear-gradient(to right, #1c648f 30%, #4281a7 89%);">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-xs-12 about-company">
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3952.2350187834395!2d112.64624!3d-7.8704586!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3e06a0e0a9fd256e!2sPonpes%20Negeri%20Akhirat%20(PPNA)!5e0!3m2!1sen!2sid!4v1581309746156!5m2!1sen!2sid"
                            width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-12 links">
                    {{-- <h4 class="mt-lg-0 mt-sm-3">Links</h4> --}}
                    <ul class="m-0 p-0">


                </div>
                <div class="col-lg-4 col-xs-12" style="color: aliceblue">
                    <br>
                    <h4 class="mt-lg-0 mt-sm-4">Lokasi</h4>
                    <p><i class="fas fa-map-marker-alt mr-3"></i> Jl. Sempit Biru Desa Gunungrejo Kecamatan Singosari
                        Kabupaten Malang Jawa Timur 65153</p>
                    <h4 class="mt-lg-0 mt-sm-4">Telepon</h4>
                    <p class="mb-0"><i class="fa fa-phone mr-3"></i>081359069006</p>
                    <br>
                    <a href="{{route('liatDev')}}" class="text-light"><i class="fas fa-code mr-2"></i>Developer</a>
                </div>
                </ul>
            </div>
        </div>
    </div>

    <!-- Copyright -->
    <footer class="py-3" style="background-color: #1C648F">
        <div class="container">
            <p class="m-0 text-center text-white">Pondok Pesantren Negeri Akhirat</p>
        </div>
    </footer>
    <!-- Copyright -->


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
                        scrollTop: $(hash).offset().top - 40
                    }, 800, function(){

                        // Add hash (#) to URL when done scrolling (default click behavior)
                        // window.location.hash = hash;
                    });
                    }  // End if
                });
            });


                //AJAX LOAD MORE PENGUMUMAN DISINI YA
                $(document).ready(function(){

                    var _token = $('input[name="_token"]').val();

                    //load_data('', _token);

                    function load_data(id="", _token)
                    {
                        $.ajax({
                            url:"{{ route('loadpengumuman') }}",
                            method:"POST",
                            data:{id:id, _token:_token},
                            success:function(data)
                            {
                                $('#load_more_button').remove();
                                $('#kotakpengumuman').append(data);
                            }
                        })
                    }

                    $(document).on('click', '#load_more_button', function(){
                        var id = $(this).data('id');
                        $('#load_more_button').html('<b>Tunggu...</b>');
                        load_data(id, _token);
                    });
                });

    //AJAX LOAD MORE ARTIKEL DISINI YA
    $(document).ready(function(){

        var _token = $('input[name="_token"]').val();


        function load_data_artikel(id="", _token)
        {
            $.ajax({
                url:"{{ route('loadartikel') }}",
                method:"POST",
                data:{id:id, _token:_token},
                success:function(data)
                {
                    $('#load_more_button_artikel').remove();
                    $('#kotakartikel').append(data);
                }
            })
        }

        $(document).on('click', '#load_more_button_artikel', function(){
            var id = $(this).data('id');
            $('#load_more_button_artikel').html('<b>Tunggu...</b>');
            load_data_artikel(id, _token);
        });
    });




        $(document).ready(function() {

        /* Every time the window is scrolled ... */
        $(window).scroll( function(){

            /* Check the location of each desired element */
            $('.hideme').each( function(i){

                var bottom_of_object = $(this).position().top + $(this).outerHeight();
                var bottom_of_window = $(window).scrollTop() + $(window).height();

                /* If the object is completely visible in the window, fade it it */
                if( bottom_of_window > bottom_of_object ){

                    $(this).animate({'opacity':'1'},1500);

                }

            });

        });

        });


    </script>
</body>

</html>
