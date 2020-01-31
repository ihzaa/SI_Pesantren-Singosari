@extends('admin.template.all')

@section('title','Admin')
@section('Judul','Kelola Carousel')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <th>Status</th>
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
                        <th>Status</th>
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
                        <td>{{str_limit($s->deskripsi,10)}}</td>
                        <td>{{$s->dibuat}}</td>
                        <td>
                            <div class="row justify-content-center">
                                @if($s->status == 'nonaktif')
                                <button type="button" class="btn btn-outline-info btn-sm btn-aktif"
                                    data-target="{{$i}}">Aktifkan</button>
                                <button type="button" class="btn btn-outline-danger btn-sm btn-nonaktif"
                                    style="display: none;" data-target="{{$i}}">Nonaktifkan</button>
                                <button class="btn btn-outline-primary btn-sm btn-loading" type="submit"
                                    style="display: none;">
                                    <span class="spinner-border spinner-border-sm"></span>
                                </button>
                                <input type="hidden" name="idcar{{$i}}" value="{{$s->id}}">
                                @else
                                <button type="button" class="btn btn-outline-info btn-sm btn-aktif"
                                    data-target="{{$s->id}}" style="display: none;">Aktifkan</button>
                                <button type="button" class="btn btn-outline-danger btn-sm btn-nonaktif"
                                    data-target="{{$s->id}}">Nonaktifkan</button>
                                <button class="btn btn-outline-primary btn-sm btn-loading" type="submit"
                                    style="display: none;">
                                    <span class="spinner-border spinner-border-sm"></span>
                                </button>
                                <input type="hidden" name="idcar{{$s->id}}" value="{{$s->id}}">
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="row justify-content-center">
                                {{-- <a href="#" class="btn btn-info btn-circle btn-sm" title="Edit" data-toggle="modal"
                                    data-target="#editModal" data-id="{{$s->id}}" data-nama="{{$s->nama}}"
                                data-deskripsi="{{$s->deskripsi}}">
                                <i class="fas fa-user-edit text-light"></i>
                                </a> --}}
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
                <form class="user" action="{{route('admintambahcarousel')}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-6">
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama"
                                required="">
                        </div>
                        <div class="col-6">
                            <label>File Foto</label>
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
                        <button type="submit" class="btn btn-primary" href="#">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL Edit -->
{{-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Carousel</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{route('admineditcarousel')}}" method="POST" enctype="multipart/form-data">
@csrf
<input type="hidden" id="id" name="id">
<div class="form-group row">
    <div class="col-6">
        <label>Nama</label>
        <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama" required="">
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
        <textarea required="" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi"
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
</div> --}}

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
                <form class="user" action="{{route('adminhapuscarousel')}}" method="POST">
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
    // $('#editModal').on('show.bs.modal', function (event) {
    //     var button = $(event.relatedTarget) // Button that trigg  ered the modal
    //     var modal = $(this)

    //     modal.find('.modal-body #id').val(button.data('id'))
    //     modal.find('.modal-body #nama').val(button.data('nama'))
    //     modal.find('.modal-body #file').val(button.data('foto'))
    //     modal.find('.modal-body #deskripsi').val(button.data('deskripsi'))
    //     })

    $('#hapusModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that trigg  ered the modal
        var modal = $(this)

        modal.find('.modal-body #id').val(button.data('id'))
        modal.find('.modal-body #nama').val(button.data('nama'))
        })

    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
      });

    $(".btn-aktif").click(function(){

        $(this).next().next().toggle();
        $(this).hide();
        var a = $(this);
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            type: 'post',
            url: '/4dm1n/kelola-carousel/aktif',
            data: {
                'idcar':  $('input[name=idcar'+$(this).data('target')+']').val()
            },
            success: function(data) {
                akt(a);
            },
            error: function(data){
                alert("fail");
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
            url: '/4dm1n/kelola-carousel/nonaktif',
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
        function non($btn){
         $btn.prev(".btn-aktif").toggle();
         $btn.next(".btn-loading").hide();
        }
</script>

@endsection
