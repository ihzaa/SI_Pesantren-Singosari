<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pondok Pesantren Negeri Akhirat</title>

    <link rel='icon' href='/img/logo.png' type='image/x-icon' style="height: 25px;">
    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/blog-post.css" rel="stylesheet">

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #4281A7">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img class="img-fluid" src="/img/logo.png" alt="" style="height: 45px;">
            </a>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Title -->
                <h1 class="mt-4 text-center">{{$artikel->nama}}</h1>
                <hr>
                <!-- Date/Time -->
                <div class="d-flex flex-row-reverse" style="margin-bottom: -12px;">
                    <p style="color: #4281A7;">
                        {{Carbon\Carbon::parse($artikel->create_at)->isoFormat('H:mm, Do MMMM YYYY')}}</p>
                </div>
                <hr>
                <!-- Post Content -->
                <?php
                    echo $artikel->content;
                ?>
                <hr>
                @if($artikel->file_artikel != null)
                <p>Download :</p>
                <ul>
                    @foreach ($artikel->file_artikel as $item)
                    <li><a href="{{URL::to('/'.$item->path)}}">{{$item->nama}}</a></li>
                    @endforeach
                </ul>
                <hr>
                @endif

            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-lg-4">
                <!-- Side Widget -->
                <div class="card my-4 shadow">
                    <h5 class="card-header">Artikel Lainnya</h5>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach (\App\artikel::whereNotIn('id',array($artikel->id))->get() as $item)
                            <a href="/informasi/{{$item->id}}">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-8 text-center  d-flex align-items-center"
                                            style="color: #4281A7;">
                                            {{str_limit($item->nama,30)}}
                                        </div>
                                    </div>
                                </li>
                            </a>
                            <br>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Widgets Column -->


    </div>

    <!-- Footer -->
    <footer class="py-3 " style="background-color: #4281A7;position: absolute; bottom: 0;width: 100%;">
        <div class="container">
            <p class="m-0 text-center text-white">Pondok Pesantren Negeri Akhirat</p>
        </div>
        <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/all.js"></script>


</body>

</html>
