@extends('admin.template.all')

@section('title','Admin')
@section('Judul','Kelola Kelas '.ucfirst(\App\kelas::where('id',$id_kls)->pluck('nama')[0]))
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Custom styles for this page -->
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<?php
    $kls = \App\tahun_ajaran::where('id',$id_ta)->first();
?>
<a href='/4dm1n/kelola-pembelajaran/{{$kls->id}}' class="btn btn-sm btn-outline-info mb-2">
    <span class="text">Kembali</span>
</a>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" href="#">Pengajar dan Mata Pelajaran</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/4dm1n/kelola-pembelajaran/{{$id_ta}}/kelola-kelas/{{$id_kls}}/santri">Santri</a>
    </li>
</ul>
<div class="card shadow mb-4">
    <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
        <h6 class="mb-0 font-weight-bold text-primary"></h6>
        <div>
            <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#tambahModalMatPel">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Matpel</th>
                        <th>Pengajar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama Matpel</th>
                        <th>Pengajar</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                  		$i = 1;
                  	?>
                    @foreach(\App\pembelajaran::where('id_kelas',$id_kls)->get() as $s)

                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$s->pengajar_mata_pelajaran->mata_pelajaran->nama}}</td>
                        <td>{{$s->pengajar_mata_pelajaran->pengajar->nama}}</td>
                        <td>
                            <div class="row justify-content-center">
                                <a href="#" data-toggle="modal" data-target="#hapusModal"
                                    class="btn btn-danger btn-circle btn-sm" title="Hapus"
                                    data-id="{{$s->pengajar_mata_pelajaran->id}}"
                                    data-matpel="{{$s->pengajar_mata_pelajaran->mata_pelajaran->nama}}"
                                    data-pengajar="{{$s->pengajar_mata_pelajaran->pengajar->nama}}">
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

<!-- MODAL TAMBAH MATA PELAJARAN -->
<div class="modal fade" id="tambahModalMatPel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Mata Pelajaran</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{route('kelas_matpel_tambah')}}" method="POST">
                    @csrf
                    <input type="hidden" name="id_ta" value="{{$id_ta}}">
                    <input type="hidden" name="id_kls" value="{{$id_kls}}">
                    <div class="form-group row">
                        <div class="col-6">
                            <label>Mata Pelajaran</label>
                            <select name="id_matpel" class="form-control" required="">
                                <?php
                                    $pem = \App\pembelajaran::where('id_kelas',$id_kls)->pluck('id_pengajar_mata_pelajaran');
                                    if(empty($pem)){
                                        $pem = array(0);
                                    }
                                    $temp = \App\pengajar_mata_pelajaran::whereIn('id',$pem)->pluck('id_mata_pelajaran');
                                    if(empty($temp)){
                                        $temp = array(0);
                                    }
                                ?>

                                @foreach(\App\mata_pelajaran::whereNotIn('id', $temp)->get() as $m)
                                <option value="{{$m->id}}">{{$m->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label>Pengajar</label>
                            <select name="id_pengajar" class="form-control" required="">
                                @foreach(\App\pengajar::get() as $m)
                                <option value="{{$m->id}}">{{$m->nama}}</option>
                                @endforeach
                            </select>
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
                <h5 class="modal-title" id="exampleModalLabel">Hapus Carousel?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{route('kelas_matpel_hapus')}}" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id">
                    <div class="form-group row">
                        <div class="col-6">
                            <label>Mata Pelajaran</label>
                            <input type="text" class="form-control" id="matpel" disabled="">
                        </div>
                        <div class="col-6">
                            <label>Pengajar</label>
                            <input type="text" class="form-control" id="pengajar" disabled="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
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
    $('#hapusModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that trigg  ered the modal
        var modal = $(this)

        modal.find('.modal-body #id').val(button.data('id'))
        modal.find('.modal-body #matpel').val(button.data('matpel'))
        modal.find('.modal-body #pengajar').val(button.data('pengajar'))
    })
</script>
@endsection
