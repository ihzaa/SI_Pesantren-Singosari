@extends('admin.template.all')
@section('title','Admin')
@section('Judul','Kelola Pengajar')

@section('css')
<!-- Custom styles for this page -->
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
        <h6 class="mb-0 font-weight-bold text-primary">Tabel Pengajar</h6>
        <div>
            <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#tambahModal">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Tambah Pengajar Manual</span>
            </a>

            <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#tambahModalFile">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Tambah Pengajar Dengan File</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                            $i = 1;
                        ?>
                    @foreach($pengajar as $s)

                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{str_limit($s->nama,30)}}</td>
                        <td>{{$s->nip}}</td>
                        <td>{{$s->email}}</td>
                        <td>{{$s->telp}}</td>
                        <td>
                            <div class="row justify-content-center">
                                <a href="#" data-toggle="modal" data-target="#detailModal"
                                    class="btn btn-info btn-circle btn-sm" title="Detail dan Edit" data-id="{{$s->id}}"
                                    data-nama="{{$s->nama}}" data-nip="{{$s->nip}}" data-jk="{{$s->jenis_kelamin}}"
                                    data-tgl="{{$s->tanggal_lahir}}" data-tmpt="{{$s->tempat_lahir}}"
                                    data-telp="{{$s->telp}}" data-email="{{$s->email}}">
                                    <i class="fas fa-user-edit text-light"></i>
                                </a>

                                <a href="#" data-toggle="modal" data-target="#hapusModal"
                                    class="btn btn-danger btn-circle btn-sm" title="Hapus" data-id="{{$s->id_user}}"
                                    data-nama="{{$s->nama}}" data-nip="{{$s->nip}}">
                                    <i class="fas fa-trash text-light"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- MODAL DETAIL -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{route('admin_ubah_data_pengajar')}}" method="POST">
                    @include('Form.formpengajar_atas')
                    <input type="number" id="nip" class="form-control" id="nip" placeholder="NIP" name="nip" required=""
                        disabled="">
                    @include('Form.formpengajar_bawah')
            </div>
        </div>
    </div>
</div>
<!-- MODAL TAMBAH -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pengajar</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{route('admin_tambah_pengajar')}}" method="POST">
                    @include('Form.formpengajar_atas')
                    <input type="number" id="nip" class="form-control" id="nip" placeholder="NIP" name="nip"
                        required="">
                    @include('Form.formpengajar_bawah')
            </div>
        </div>
    </div>
</div>
<!-- MODAL MENU TAMBAH -->
<div class="modal fade" id="tambahModalFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pengajar dengan File</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{route('admin_tambah_file_pengajar')}}" enctype="multipart/form-data"
                    method="POST">
                    @csrf
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="file" required="">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p><br>Syarat file yang dapat di upload : </p>
                            <ul>
                                <li>Ukuran maksimal 10MB</li>
                                <li>Format .csv</li>
                                <li>Urutan kolom sesuai contoh file
                                    <a href="{{URL::to('/')}}/Downloadable/Contoh File CSV Pengajar.csv">
                                        <i class="fas fa-download fa-sm text-primary"></i> Download contoh
                                        file csv
                                    </a>
                                </li>
                                <li>Penulisan tanggal lahir hh/bb/tttt <strong>contoh:20/10/1998</strong>
                                </li>
                                <li>Jangan menghapus atau merubah nama kolom</li>
                            </ul>
                            <p><br><strong>NIS tidak dapat dirubah</strong></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" href="#">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL HAPUS -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Akun?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{route('admin_hapus_pengajar')}}" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama"
                                disabled="">
                        </div>
                        <div class="col-sm-6">
                            <label for="nis">NIP</label>
                            <input type="number" class="form-control" id="nip" placeholder="NIS" name="nip" disabled="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" href="#">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection


    @section('js')
    <!-- Page level plugins -->
    <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

    <script>
        $('#detailModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that trigg  ered the modal
        var modal = $(this)

        modal.find('.modal-body #id').val(button.data('id'))
        modal.find('.modal-body #nama').val(button.data('nama'))
        modal.find('.modal-body #nip').val(button.data('nip'))
        modal.find('.modal-body #jenis_kelamin').val(button.data('jk'))
        modal.find('.modal-body #telp').val(button.data('telp'))
        modal.find('.modal-body #tempat_lahir').val(button.data('tmpt'))
        modal.find('.modal-body #tanggal_lahir').val(button.data('tgl'))
        modal.find('.modal-body #email').val(button.data('email'))
        })

      $('#hapusModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that trigg  ered the modal
        var modal = $(this)

        modal.find('.modal-body #id').val(button.data('id'))
        modal.find('.modal-body #nama').val(button.data('nama'))
        modal.find('.modal-body #nip').val(button.data('nip'))
        })

      $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });
    </script>

    @endsection
