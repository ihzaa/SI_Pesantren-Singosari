@extends('admin.template.all')
@section('title','Admin')
@section('Judul','Kelola Pembelajaran')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                <span class="text">Tambah Tahun Ajaran</span>
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
                        <th>Semester</th>
                        <th>Jumlah Pengajar</th>
                        <th>Jumlah Santri</th>
                        <th>Jumlah Mata Pelajaran</th>
                        <th>Dibuat Pada</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Semester</th>
                        <th>Jumlah Pengajar</th>
                        <th>Jumlah Santri</th>
                        <th>Jumlah Mata Pelajaran</th>
                        <th>Dibuat Pada</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                            $i = 1;
                        ?>
                    @foreach($ta as $s)

                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$s->nama}}</td>
                        <td>
                            <?php
                            if($s->semester == 'ganjil'){
                                echo 'Ganjil';
                            }else{
                                echo 'Genap';
                            }
                            ?>
                        </td>
                        <td>{{count($s->pengajar_tahun_ajaran)}}</td>
                        <td>{{count($s->kelas_tahun_ajaran)}}</td>
                        <td>{{count($s->mata_pelajaran_tahun_ajaran)}}</td>
                        <td>{{$s->dibuat}}</td>
                        <td>
                            <div class="row justify-content-center">
                                @if($s->status == 'nonaktif')
                                <button type="button" id="btnaktf{{$i}}" class="btn btn-outline-info btn-sm btn-aktif"
                                    data-target="{{$i}}">Aktifkan</button>
                                <button type="button" id="btnnaktf{{$i}}"
                                    class="btn btn-outline-danger btn-sm btn-nonaktif" style="display: none;"
                                    data-target="{{$i}}">Nonaktifkan</button>
                                <button id="btnldng{{$i}}" class="btn btn-outline-primary btn-sm btn-loading"
                                    type="submit" style="display: none;">
                                    <span class="spinner-border spinner-border-sm"></span>
                                </button>
                                <input type="hidden" name="idcar{{$i}}" value="{{$s->id}}">
                                @else
                                <button type="button" id="btnaktf{{$i}}" class="btn btn-outline-info btn-sm btn-aktif"
                                    data-target="{{$s->id}}" style="display: none;">Aktifkan</button>
                                <button type="button" id="btnnaktf{{$i}}"
                                    class="btn btn-outline-danger btn-sm btn-nonaktif"
                                    data-target="{{$s->id}}">Nonaktifkan</button>
                                <button id="btnldng{{$i}}" class="btn btn-outline-primary btn-sm btn-loading"
                                    type="submit" style="display: none;">
                                    <span class="spinner-border spinner-border-sm"></span>
                                </button>
                                <input type="hidden" name="idcar{{$s->id}}" value="{{$s->id}}">
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="row justify-content-center">
                                <a href="#" class="btn btn-info btn-circle btn-sm" title="Edit" data-toggle="modal"
                                    data-target="#editModal" data-id="{{$s->id}}" data-nama="{{$s->nama}}"
                                    data-semester="{{$s->semester}}">
                                    <i class="fas fa-user-edit text-light"></i>
                                </a>
                                <a href="/4dm1n/kelola-pembelajaran/{{$s->id}}-{{$s->semester}}"
                                    class="btn btn-success btn-circle btn-sm" title="Kelola Tahun Ajaran">
                                    <i class="fas fa-cog text-light"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-circle btn-sm" title="Hapus" data-toggle="modal"
                                    data-target="#hapusModal" data-id="{{$s->id}}" data-nama="{{$s->nama}}"
                                    data-nip="{{$s->semester}}">
                                    <i class=" fas fa-trash text-light"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="container">
                <p><br><strong>Catatan : </strong>Hanya dapat mengaktifkan 1 tahun ajaran</p>
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
                <h5 class="modal-title" id="exampleModalLabel">Tambah Tahun Ajaran</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{route('admin_tambah_tahun_ajaran')}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama"
                                required="">
                        </div>
                        <div class="col-sm-6">
                            <label>Semester</label>
                            <select class="form-control" name="semester" id="semester">
                                <option value="ganjil">Ganjil</option>
                                <option value="genap">Genap</option>
                            </select>
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
                <h5 class="modal-title" id="exampleModalLabel">Edit Tahun Ajaran</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{route('admin_edit_tahun_ajaran')}}" method="POST">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="form-group row">
                        <div class="col-sm-6">
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama"
                                required="">
                        </div>
                        <div class="col-sm-6">
                            <label>Semester</label>
                            <select class="form-control" name="semester" id="semester">
                                <option value="ganjil">Ganjil</option>
                                <option value="genap">Genap</option>
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
                <h5 class="modal-title" id="exampleModalLabel">Hapus Tahun Ajaran?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{route('admin_hapus_tahun_ajaran')}}" method="POST">
                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id">
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama"
                                disabled="">
                        </div>
                        <div class="col-sm-6">
                            <label for="nis">Semester</label>
                            <input type="text" class="form-control" id="nip" placeholder="NIS" name="nip" disabled="">
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
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that trigg  ered the modal
        var modal = $(this)

        modal.find('.modal-body #id').val(button.data('id'))
        modal.find('.modal-body #nama').val(button.data('nama'))
        modal.find('.modal-body #semester').val(button.data('semester'))
        })

    $('#hapusModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that trigg  ered the modal
        var modal = $(this)

        modal.find('.modal-body #id').val(button.data('id'))
        modal.find('.modal-body #nama').val(button.data('nama'))
        modal.find('.modal-body #nip').val(button.data('nip'))
        })

    $(".btn-aktif").click(function(){
        $(this).next().next().toggle();
        $(this).hide();
        var a = $(this);
        var b = $(this).attr('id');
        var c = $(this).data('target');
        // var c = $(this).next().next().arrt('id');
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            type: 'post',
            url: '/4dm1n/kelola-pembelajaran/aktif',
            data: {
                'idcar':  $('input[name=idcar'+$(this).data('target')+']').val()
            },
            success: function(data) {
                if(data == 1)
                    akt(a);
                else if(data == 0){
                    wadaw(c);
                }
            },
            error: function(data){
                alert("Hanya dapat mengaktifkan 1");
            }
        });
        });

    $(".btn-nonaktif").click(function(){

        $(this).next(".btn-loading").toggle();
        $(this).hide();
        var a = $(this);
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            type: 'post',
            url: '/4dm1n/kelola-pembelajaran/nonaktif',
            data: {
                'idcar':  $('input[name=idcar'+$(this).data('target')+']').val()
            },
            success: function(data) {
                non(a);
            },
            error: function(data){
                alert("fail");
            }
        });
    });

    function akt($btn){
    $btn.next(".btn-nonaktif").toggle();
    $btn.next().next().hide();
    }
    function akt2($btn){
    $btn.toogle();
    $btn.next().next().hide();
    }
    function non($btn){
    $btn.prev(".btn-aktif").toggle();
    $btn.next(".btn-loading").hide();
    }

    function wadaw($a) {
        var x = document.getElementById('btnaktf'+$a);
        var z = document.getElementById('btnldng'+$a);
        alert('Hanya 1 Tahun ajaran yang boleh aktif dalam waktu yang sama');
        x.style.display = "block";
        z.style.display = "none";

    }
</script>

@endsection
