@extends('admin.template.all')

@section('title','Admin')
@section('Judul','Kelola Donasi')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Custom styles for this page -->
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="/css/centang.css">
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
        <h6 class="mb-0 font-weight-bold text-primary">Donasi</h6>
        <div class="col-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Target Donasi</span>
                </div>
                <input type="number" min="1" id="intarget" class="form-control" name="target"
                    value="{{\App\donasi::first()->Target}}" placeholder="Target Donasi"
                    aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-sm btn-primary btn-dnsi">
                        <span class="icon text-white-50 fa fa-check">
                        </span>
                    </button>
                </div>
            </div>
        </div>
        <div>
            <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#tambahModal">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Tambah Donasi Masuk</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Dari Rek.</th>
                        <th>Nominal</th>
                        <th>Dibuat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Dari Rek.</th>
                        <th>Nominal</th>
                        <th>Dibuat</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $i = 1;
                    ?>
                    @foreach($d as $s)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$s->dari_rekening}}</td>
                        <td>{{$s->nominal}}</td>
                        <td>{{$s->dibuat}}</td>
                        <td>
                            <div class="row justify-content-center">
                                <a href="#" class="btn btn-info btn-circle btn-sm" title="Edit" data-toggle="modal"
                                    data-target="#editModal" data-id="{{$s->id}}" data-rek="{{$s->dari_rekening}}"
                                    data-nominal="{{$s->nominal}}">
                                    <i class="fas fa-user-edit text-light"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-circle btn-sm" title="Hapus" data-toggle="modal"
                                    data-target="#hapusModal" data-id="{{$s->id}}" data-rek="{{$s->dari_rekening}}"
                                    data-nominal="{{$s->nominal}}">
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

<!-- MODAL SUKSES -->
<div class="modal fade" id="suksesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sukses Merubah Target Donasi</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
                            <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);">
                            </div>
                            <span class="swal2-success-line-tip"></span>
                            <span class="swal2-success-line-long"></span>
                            <div class="swal2-success-ring"></div>
                            <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                            <div class="swal2-success-circular-line-right"
                                style="background-color: rgb(255, 255, 255);"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">OK</button>
                </div>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Donasi Masuk</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{route('admintambahdonasimasuk')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col">
                            <label>No Rek.</label>
                            <input type="text" class="form-control" placeholder="Nomer Rekening" id="nama" name="rek"
                                required="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label>Nominal</label>
                            <input type="number" min="1" class="form-control" placeholder="Nominal" id="nama"
                                name="nominal" required="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" href="#">Tambah</button>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Donasi Masuk</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{route('admineditdonasimasuk')}}" method="POST">
                    <input type="hidden" name="id" id="id">
                    @csrf
                    <div class="form-group row">
                        <div class="col">
                            <label>No Rek.</label>
                            <input type="text" class="form-control" placeholder="Nomer Rekening" id="rek" name="rek"
                                required="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label>Nominal</label>
                            <input type="number" min="1" class="form-control" placeholder="Nominal" id="nominal"
                                name="nominal" required="">
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
                <h5 class="modal-title" id="exampleModalLabel">Hapus Donasi Masuk?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{route('adminhapusdonasimasuk')}}" method="POST">
                    <input type="hidden" name="id" id="id">
                    @csrf
                    <div class="form-group row">
                        <div class="col">
                            <label>No Rek.</label>
                            <input type="text" disabled="" class="form-control" placeholder="Nomer Rekening" id="rek"
                                name="rek" required="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label>Nominal</label>
                            <input disabled="" type="number" class="form-control" placeholder="Nominal" id="nominal"
                                name="nominal" required="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" href="#">Hapus</button>
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
        modal.find('.modal-body #rek').val(button.data('rek'))
        modal.find('.modal-body #nominal').val(button.data('nominal'))
        })

    $('#hapusModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that trigg  ered the modal
        var modal = $(this)

        modal.find('.modal-body #id').val(button.data('id'))
        modal.find('.modal-body #rek').val(button.data('rek'))
        modal.find('.modal-body #nominal').val(button.data('nominal'))
        })

        $(".btn-dnsi").click(function(){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type: 'post',
                url: '/4dm1n/kelola-donasi/total/edit',
                data: {
                    'target':  $('input[name=target]').val()
                },
                success: function(data) {
                    $('#suksesModal').modal('show');
                },
                error: function(data){
                    alert("fail");
                }
            });
            });
</script>

@endsection
