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
<div id="menu1" class="card shadow mb-4">
    <a href="#collapseCard" class="d-block card-header py-3 d-flex" data-toggle="collapse" role="button"
        aria-expanded="true" aria-controls="collapseCardExample">
        <h6 class="m-0 font-weight-bold text-primary mr-auto">Kolom kiri Donasi </h6>
        <h6 class="m-0 font-weight-bold text-warning">Klik untuk tampilkan / sembunyikan</h6>
    </a>
    <div class="collapse" id="collapseCard">
        <div class="card-body">
            <form method="POST" id="form_kiri" enctype="multipart/form-data" class="user">
                @csrf
                <?php
                $data = \App\donasi::first();
            ?>
                <div class="form-group row">
                    <div class="col">
                        <label>Judul</label>
                        <input type="text" class="form-control" value="{{$data->judul}}" placeholder="Judul" id="judul"
                            name="judul">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label>Deskripsi</label>
                        <textarea class="form-control" placeholder="Deskripsi" name="desc" id="desc"
                            rows="4">{{$data->deskripsi}}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="file" name="file">
                            <label class="custom-file-label" for="customFile">{{$data->foto}}</label>
                        </div>
                        <div class="row mt-3">
                            <div class="col-8">
                                <img class="img-fluid" id="view" src="{{$data->foto}}" alt="image" width="500"
                                    height="500">
                            </div>
                            <div class="col-4">
                                <p>Syarat foto: </p>
                                <ul>
                                    <li>Ekstensi jpg, jpeg, png</li>
                                    <li>Ukuran max : 5MB</li>
                                    <li>Resolusi 500 x 500</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-simpan" class="btn btn-primary" href="#">Simpan</button>
                    <button class="btn btn-outline-primary btn-loading" id="btn-ldg-atas" style="display: none;"
                        type="submit">
                        <span class="spinner-border"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="menu2" class="card shadow mb-4">
    <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
        <div class="col-4">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Target Donasi</span>
                </div>
                <input type="text" min="1" id="intarget" class="form-control" name="target"
                    value="{{\App\donasi::first()->Target}}" placeholder="Target Donasi" aria-describedby="basic-addon2"
                    required="">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-sm btn-primary btn-dnsi">
                        <span id="cek" class="icon text-white-50 fa fa-check"></span>
                        <div id="ldg" class="spinner-border spinner-border-sm text-primary" role="status"
                            style="display:none;"></div>
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
                        <th>Nama</th>
                        <th>Nominal</th>
                        <th>Dibuat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
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
                        <td>{{$s->nama}}</td>
                        <td>Rp. {{number_format($s->nominal)}}</td>
                        <td>{{Carbon\Carbon::parse($s->dibuat)->isoFormat('dddd, Do MMMM YYYY, H:mm')}}</td>
                        <td>
                            <div class="row justify-content-center">
                                <a href="#" class="btn btn-info btn-circle btn-sm" title="Edit" data-toggle="modal"
                                    data-target="#editModal" data-id="{{$s->id}}" data-rek="{{$s->nama}}"
                                    data-nominal="{{$s->nominal}}">
                                    <i class="fas fa-user-edit text-light"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-circle btn-sm" title="Hapus" data-toggle="modal"
                                    data-target="#hapusModal" data-id="{{$s->id}}" data-rek="{{$s->nama}}"
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

<!-- MODAL SUKSES KOLOM KIRI -->
<div class="modal fade" id="kirisuksesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Perubahan Disimpan</h5>
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

<!-- MODAL GAGAL KOLOM KIRI -->
<div class="modal fade" id="kirigagalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Perubahan Tidak Disimpan Syarat Foto Tidak Memenuhi</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                            <span class="swal2-x-mark">
                                <span class="swal2-x-mark-line-left"></span>
                                <span class="swal2-x-mark-line-right"></span>
                            </span>
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
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="Nama Pengirim" id="nama" name="rek"
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
                            <label>Nama</label>
                            <input type="text" class="form-control" placeholder="Nama Pengirim" id="rek" name="rek"
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
                            <label>Nama</label>
                            <input type="text" disabled="" class="form-control" placeholder="Nama Pengirim" id="rek"
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
    $(document).ready(function(){
        var $input = $('input[name=target]');

        var $this = $input;

        // Get the value.
        var input = $this.val();

        var input = input.replace(/[\D\s\._\-]+/g, "");
        input = input ? parseInt( input, 10 ) : 0;

        $this.val( function() {
            return ( input === 0 ) ? "" : input.toLocaleString( "en-US" );
        } );

    });

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
            wadaw();
            var trt = $('input[name=target]').val();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                type: 'post',
                url: '/4dm1n/kelola-donasi/total/edit',
                data: {
                    'target': trt.replace(",","")
                },
                success: function(data) {
                    wadaw1();
                    $('#suksesModal').modal('show');
                },
                error: function(data){
                    alert("fail");
                }
            });
            });

            function wadaw() {
                var x = document.getElementById('cek');
                var z = document.getElementById('ldg');
                z.style.display = "block";
                x.style.display = "none";
            }

            function wadaw1() {
                var x = document.getElementById('cek');
                var z = document.getElementById('ldg');
                x.style.display = "block";
                z.style.display = "none";
            }

    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
        $('#view').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
    }

    $("#file").change(function() {
    readURL(this);
    });

        $("#form_kiri").on('submit',function(){
            hideldgatas();
            event.preventDefault();
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
            $.ajax({
                method: 'post',
                url: '{{route('simpankolokkiridonasi')}}',
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    tampilinldgatas();
                    if(data == 1)
                        $('#kirisuksesModal').modal('show');
                    else if(data == 2)
                        $('#kirigagalModal').modal('show');
                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    alert(err.Message);
                }
            });
            });

            function hideldgatas(){
                document.getElementById('btn-ldg-atas').style.display = "block";
                document.getElementById('btn-simpan').style.display = "none";
            }
            function tampilinldgatas()
            {
                document.getElementById('btn-simpan').style.display = "block";
                document.getElementById('btn-ldg-atas').style.display = "none";
            }

            // JS untuk input mata uang
            (function($, undefined) {

                "use strict";

                // When ready.
                $(function() {

                    // var $form = $( "#form" );
                    var $input = $('input[name=target]');

                    $input.on( "keyup", function( event ) {


                        // When user select text in the document, also abort.
                        var selection = window.getSelection().toString();
                        if ( selection !== '' ) {
                            return;
                        }

                        // When the arrow keys are pressed, abort.
                        if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
                            return;
                        }


                        var $this = $( this );

                        // Get the value.
                        var input = $this.val();

                        var input = input.replace(/[\D\s\._\-]+/g, "");
                                input = input ? parseInt( input, 10 ) : 0;

                                $this.val( function() {
                                    return ( input === 0 ) ? "" : input.toLocaleString( "en-US" );
                                } );
                    } );
                });
                })(jQuery);
</script>

@endsection
