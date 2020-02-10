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
                <?php
                    echo "<p>$pengumuman->isi</p>";
                ?>

                <hr>

            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Side Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Berita Lainnya</h5>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            @foreach (\App\pengumuman::get()->take(10) as $item)
                            <a href="/pengumuman/{{$item->id}}/{{$item->judul}}">
                                <li class="list-unstyled-item">
                                    <div class="row">
                                        <div class="col-4">
                                            <img class="img-fluid" src="/{{$item->foto}}" alt="">
                                        </div>
                                        <div class="col-8 text-center  d-flex align-items-center">
                                            {{str_limit($item->judul,30)}}
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
        <!-- /.row -->

    </div>
    <!-- /.container -->
    <nav id="sidebar">
        <div class="card my-4">
            <h5>Categories</h5>
            <ul class="list-unstyled components mb-5">
                <li>
                    <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Mens
                        Shoes</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu1">
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Casual</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Football</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Jordan</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Lifestyle</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Running</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Soccer</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Sports</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Mens
                        Shoes</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu2">
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Casual</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Football</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Jordan</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Lifestyle</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Running</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Soccer</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Sports</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu3" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">Accessories</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu3">
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Nicklace</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Ring</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Bag</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Sacks</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Lipstick</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu4" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle">Clothes</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu4">
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Jeans</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> T-shirt</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Jacket</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Shoes</a></li>
                        <li><a href="#"><span class="fa fa-chevron-right mr-2"></span> Sweater</a></li>
                    </ul>
                </li>
            </ul>
            <div class="mb-5">
                <h5>Tag Cloud</h5>
                <div class="tagcloud">
                    <a href="#" class="tag-cloud-link">dish</a>
                    <a href="#" class="tag-cloud-link">menu</a>
                    <a href="#" class="tag-cloud-link">food</a>
                    <a href="#" class="tag-cloud-link">sweet</a>
                    <a href="#" class="tag-cloud-link">tasty</a>
                    <a href="#" class="tag-cloud-link">delicious</a>
                    <a href="#" class="tag-cloud-link">desserts</a>
                    <a href="#" class="tag-cloud-link">drinks</a>
                </div>
            </div>
            <div class="mb-5">
                <h5>Newsletter</h5>
                <form action="#" class="subscribe-form">
                    <div class="form-group d-flex">
                        <div class="icon"><span class="icon-paper-plane"></span></div>
                        <input type="text" class="form-control" placeholder="Enter Email Address">
                    </div>
                </form>
            </div>
        </div>
    </nav>
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