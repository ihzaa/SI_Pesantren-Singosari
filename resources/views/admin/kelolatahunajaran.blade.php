@extends('admin.template.all')
@section('title','Admin')

@section('Judul','Kelola Tahun Ajaran '. ucfirst($ta->nama))

@section('css')
<link rel="stylesheet" href="/css/timelinecustom.css">

<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<a href='{{route('adminkelolapembelajaran')}}' class="btn btn-sm btn-outline-info mb-2">
    <span class="text">Kembali</span>
</a>
<div class="card shadow">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Kelas</h6>
        <a title="Tambah " href="#" class="btn btn-sm btn-outline-primary btn-icon-split" data-toggle="modal"
            data-target="#tambahModalKelas" data-idta="{{$ta->id}}">
            <span class="icon"> <i class="fa fa-plus"></i></span>
            <span class="text">Tambah Kelas</span>
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jml Santri</th>
                        <th>Jml Pengajar</th>
                        <th>Jml Mata Pelajaran</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jml Santri</th>
                        <th>Jml Pengajar</th>
                        <th>Jml Mata Pelajaran</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                                                $i=1;
                                                ?>
                    @foreach($ta->kelas_tahun_ajaran as $t)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$t->kelas->nama}}</td>
                        <td>{{\App\data_per_kelas::where('id_kelas',$t->kelas->id)->count()}}</td>
                        <?php
                            $arr = array();
                            $temp = \App\pembelajaran::where('id_kelas',$t->kelas->id)->pluck('id_pengajar_mata_pelajaran');
                            foreach($temp as $a)
                            {
                                $arr = array_merge($arr,array($a));
                            }
                            $cnt = \App\pengajar_mata_pelajaran::whereIn('id',$arr)->groupBy('id_pengajar')->pluck('id_pengajar')->count();
                        ?>
                        <td>{{$cnt}}</td>
                        <td>{{\App\pembelajaran::where('id_kelas',$t->kelas->id)->count()}}</td>
                        <td>
                            <div class="row justify-content-center">
                                <a href="/4dm1n/kelola-pembelajaran/{{$ta->id}}/kelola-kelas/{{$t->id_kelas}}/mata-pelajaran"
                                    class="btn btn-success btn-circle btn-sm" title="Kelola" data-id="{{$t->id}}"
                                    data-nama="{{$t->kelas->nama}}">
                                    <i class="fas fa-cog text-light"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-circle btn-sm" title="Hapus" data-toggle="modal"
                                    data-target="#hapusModalMatpel" data-id="{{$t->id_kelas}}"
                                    data-nama="{{$t->kelas->nama}}">
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




<!-- MODAL HAPUS MATA PELAJARAN -->
<div class="modal fade" id="hapusModalMatpel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Kelas Berikut pada Semester Ini?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{route('hapus_kelas_ta')}}" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id">
                    <div class="form-group row">
                        <div class="col">
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="Nama" id="nama" disabled="">
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

<!-- MODAL TAMBAH MATA PELAJARAN -->
<div class="modal fade" id="tambahModalKelas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Kelas</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{route('tambah_kelas_ta')}}" method="POST">
                    @csrf
                    <input type="hidden" name="ta" value="{{$ta->id}}">
                    <div class="form-group row">
                        <div class="col">
                            <input type="hidden" name="id_ta">
                            <label>Nama Kelas</label>
                            <input type="text" name="nama" class="form-control">
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
    $('#hapusModalMatpel').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that trigg  ered the modal
        var modal = $(this)

        modal.find('.modal-body #id').val(button.data('id'))
        modal.find('.modal-body #nama').val(button.data('nama'))
        })

    $('#tambahModalMatPel').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that trigg  ered the modal
        var modal = $(this)

        modal.find('.modal-body #id_ta').val(button.data('idta'))
        })
</script>
@endsection
