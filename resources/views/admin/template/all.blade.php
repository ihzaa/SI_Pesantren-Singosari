<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>
    <link rel='icon' href='/img/logo.png' type='image/x-icon' style="height: 25px;">
    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    @yield('css')
    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('adminidx')}}">
                <div class=" sidebar-brand-icon">
                    <i class="fas fa-users-cog"></i>
                </div>
                <div class="sidebar-brand-text  ">Halaman Administrator</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{request()->is('4dm1n') ? 'active open' : ''}}">
                <a class="nav-link" href="{{route('adminidx')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Kelola
            </div>

            <!-- Nav Item - Pages Kelola Santri Menu -->
            <li class="nav-item {{request()->is('4dm1n/kelola-santri') ? 'active open' : ''}}">
                <a class="nav-link collapsed " href="{{route('adminkelalosantri')}}" aria-expanded="true"
                    aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-child"></i>
                    <span>Santri</span>
                </a>
            </li>

            <!-- Nav Item - Page Kelola Pengajar Menu -->
            <li class="nav-item {{request()->is('4dm1n/kelola-pengajar') ? 'active open' : ''}}">
                <a class="nav-link collapsed" href="{{route('adminkelolapengajar')}}" aria-expanded="true"
                    aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-male"></i>
                    <span>Pengajar</span>
                </a>
            </li>

            <!-- Nav Item - Page Kelola Matpel Menu -->
            <li class="nav-item {{request()->is('4dm1n/kelola-matpel') ? 'active open' : ''}}">
                <a class="nav-link collapsed" href="{{route('adminkelolamatpel')}}" aria-expanded="true"
                    aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Mata Pelajaran</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Charts -->
            <li class="nav-item {{request()->is('4dm1n/kelola-pembelajaran') ? 'active open' : ''}}
                {{request()->is('4dm1n/kelola-pembelajaran/*') ? 'active open' : ''}}" style="margin-top: -15px;">
                <a class="nav-link" href="{{route('adminkelolapembelajaran')}}">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>Kelola Pembelajaran</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Kelola Website
            </div>

            <li class="nav-item {{request()->is('4dm1n/kelola-carousel') ? 'active open' : ''}}">
                <a class="nav-link" href="{{route('adminkelolacarousel')}}">
                    <i class="far fa-images"></i>
                    <span>Kelola Carousel</span></a>
            </li>

            <li class="nav-item {{request()->is('4dm1n/kelola-donasi') ? 'active open' : ''}}">
                <a class="nav-link" href="{{route('adminkeloladonasi')}}">
                    <i class="fas fa-fw fa fa-donate"></i>
                    <span>Kelola Donasi</span></a>
            </li>

            <li class="nav-item {{request()->is('4dm1n/kelola-pengumuman*') ? 'active open' : ''}}">
                <a class="nav-link" href="{{route('adminkelolapengumuman')}}">
                    <i class="fas fa-bullhorn"></i>
                    <span>Kelola Informasi</span></a>
            </li>

            <hr class="sidebar-divider mb-0">

            <li class="nav-item">
                <a class="nav-link" href="{{route('halaman_depan')}}">
                    <i class="fas fa-globe"></i>
                    <span>Lihat Website</span></a>
            </li>

            <hr class="sidebar-divider ">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{Session::get('adminlogin')[0]->nama}}</span>
                                <i class="fas fa-user fa-lg fa-fw"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('kelola_profil')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">@yield('Judul')</h1>
                    </div>
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        Upload Validation Error<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(Session::get('pesan'))
                    <div class="alert {{Session::get('color')}} alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{Session::get('pesan')}}
                    </div>
                    @endif
                    @yield('content')
                    <!-- /.container-fluid -->
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Pondok Pesantren Negeri Akhirat</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Tekan "Logout" di bawah jika kamu ingin keluar.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{route('logout')}}">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    <script src="/js/fa5.js" crossorigin="anonymous"></script>
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugins -->
    <script src="/vendor/chart.js/Chart.min.js"></script>
    @yield('js')
    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.min.js"></script>



    <!-- Page level custom scripts -->
    {{-- <script src="/js/demo/chart-area-demo.js"></script> --}}
    {{-- <script src="/js/demo/chart-pie-demo.js"></script> --}}

</body>

</html>
