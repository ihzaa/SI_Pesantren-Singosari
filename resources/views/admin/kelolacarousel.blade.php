@extends('admin.template.all')

@section('title','Admin')
@section('Judul','Kelola Carousel')

@section('css')
<!-- Custom styles for this page -->
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
        <h6 class="mb-0 font-weight-bold text-primary">Carousel</h6>
        <div>
            <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#tambahModal">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Tambah Carousel</span>
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
                        <th>Foto</th>
                        <th>Deskripsi</th>
                        <th>Dibuat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Foto</th>
                        <th>Deskripsi</th>
                        <th>Dibuat</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $i = 1;
                    ?>
                    @foreach($cl as $s)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$s->nama}}</td>
                        <td>{{$s->foto}}</td>
                        <td>{{$s->deskripsi}}</td>
                        <td>{{$s->dibuat}}</td>
                        <td>
                            <div class="row justify-content-center">
                                <a href="#" class="btn btn-info btn-circle btn-sm" title="Edit" data-toggle="modal"
                                    data-target="#editModal" data-id="{{$s->id}}" data-nama="{{$s->nama}}">
                                    <i class="fas fa-user-edit text-light"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-circle btn-sm" title="Hapus" data-toggle="modal"
                                    data-target="#hapusModal" data-id="{{$s->id}}" data-nama="{{$s->nama}}">
                                    <i class=" fas fa-trash text-light"></i>
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

<!-- MODAL TAMBAh -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Carousel</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{route('admintambahcarousel')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="form-group row">
                        <div class="col-6">
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama"
                                required="">
                        </div>
                        <div class="col-6">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="file" required="">
                                <label class="custom-file-label" for="customFile">Pilih Foto</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label>Deskripsi</label>
                            <textarea required="" class="form-control" name="deskripsi" placeholder="Deskripsi"
                                rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" href="#">Simpan</button>
                    </div>
                </form>
            </div>
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
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });
</script>

@endsection
