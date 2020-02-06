<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pondok Pesantren Negeri Akhirat</title>

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
                <i class="fas fa-mosque"></i>
            </a>
        </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Post Content Column -->
            <div class="col-lg-8">

                <!-- Title -->
                <h1 class="mt-4">{{$pengumuman->judul}}</h1>

                <hr>

                <!-- Date/Time -->
                <p>{{$pengumuman->dibuat}}</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-fluid rounded" src="/{{$pengumuman->foto}}" alt="">

                <hr>

                <!-- Post Content -->
                <p>{{$pengumuman->isi}}</p>
                <hr>

            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Side Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Berita Lainnya</h5>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            @foreach (\App\pengumuman::get()->take(10) as $item)
                            <a href="/pengumuman/{{$item->id}}/{{$item->judul}}">
                                <li class="list-group-item">{{str_limit($item->judul,30)}}</li>
                            </a>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-3 " style="background-color: #4281A7">
        <div class="container">
            <p class="m-0 text-center text-white">Pondok Pesantren Dunia Akhirat</p>
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
