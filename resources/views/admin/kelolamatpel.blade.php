@extends('admin.template.all')
@section('title','Admin')
@section('Judul','Kelola Pembelajaran')

@section('css')
<!-- Custom styles for this page -->
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
        <h6 class="mb-0 font-weight-bold text-primary">Pembelajaran</h6>
        <div>
            <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#tambahModal">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Tambah Mata Pelajaran</span>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                            $i = 1;
                        ?>
                    @foreach($mp as $s)

                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$s->nama}}</td>
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

<!-- MODAL TAMBAH -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Tahun Ajaran</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{route('admintambahmatpel')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col">
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama"
                                required="">
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

<!-- MODAL EDIT -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Tahun Ajaran</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{route('admineditmatpel')}}" method="POST">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="form-group row">
                        <div class="col">
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama"
                                required="">
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

<!-- MODAL HAPUS -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Mata Pelajaran?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{route('adminhapusmatpel')}}" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id">
                    <div class="form-group row">
                        <div class="col">
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama"
                                disabled="">
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
</div>
@endsection

@section('js')
<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>

<script>
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that trigg  ered the modal
        var modal = $(this)

        modal.find('.modal-body #id').val(button.data('id'))
        modal.find('.modal-body #nama').val(button.data('nama'))
        })

    $('#hapusModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that trigg  ered the modal
        var modal = $(this)

        modal.find('.modal-body #id').val(button.data('id'))
        modal.find('.modal-body #nama').val(button.data('nama'))
        })
</script>

@endsection
