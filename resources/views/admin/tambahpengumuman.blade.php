@extends('admin.template.all')

@section('title','Admin')
@section('Judul','Kelola Pengumuman')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Custom styles for this page -->
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="card shadow mb-4">
    <div class="card-header">
        @if(request()->is('4dm1n/kelola-pengumuman/tambah') ? 'True' : '')
        <h5 class="" id="exampleModalLabel">Tambah Tahun Ajaran</h5>
    </div>
    <div class="card-body">
        <form class="user" action="{{route('admintambahpengumumanya')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col">
                    <label>Judul</label>
                    <input type="text" class="form-control" placeholder="judul" id="judul" name="judul" required="">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-10">
                    <label>Isi</label>
                    <textarea class="form-control" placeholder="isi" id="isi" name="isi" required=""
                        rows="10"></textarea>
                </div>
                <div class="col-2 mt-4">
                    <ul>
                        <li>Untuk baris baru gunakan &lt;br&gt;</li>
                    </ul>
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file" name="file" required="">
                        <label class="custom-file-label" for="customFile">Pilih Foto</label>
                    </div>
                    <div class="row mt-3">
                        <div class="col-8">
                            <img class="img-fluid" id="view" src="/user/santri/default.jpg" alt="image" width="500"
                                height="500">
                        </div>
                        <div class="col-4">
                            <p>Syarat foto: </p>
                            <ul>
                                <li>Ekstensi jpg, jpeg, png</li>
                                <li>Ukuran max : 5MB</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{route('adminkelolapengumuman')}}" class="btn btn-secondary" type="button"
                    data-dismiss="modal">Kembali</a>
                <button type="submit" class="btn btn-primary" href="#">Tambah</button>
            </div>
        </form>
    </div>
    @else
        <h5 class="" id="exampleModalLabel">Edit Tahun Ajaran</h5>
    </div>
    <div class="card-body">
        <form class="user" action="{{route('admintambahpengumumanya')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col">
                    <label>Judul</label>
                <input type="text" class="form-control" placeholder="judul" id="judul" name="judul" value="{{$p->judul}}" required="">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-10">
                    <label>Isi</label>
                <textarea class="form-control" placeholder="isi" id="isi" name="isi" required="" rows="10">{{$p->isi}}</textarea>
                </div>
                <div class="col-2 mt-4">
                    <ul>
                        <li>Untuk baris baru gunakan &lt;br&gt;</li>
                    </ul>
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="file" name="file" required="">
                    <label class="custom-file-label" for="customFile">{{$p->foto}}</label>
                    </div>
                    <div class="row mt-3">
                        <div class="col-8">
                            <img class="img-fluid" id="view" src="/user/santri/default.jpg" alt="image" width="500"
                                height="500">
                        </div>
                        <div class="col-4">
                            <p>Syarat foto: </p>
                            <ul>
                                <li>Ekstensi jpg, jpeg, png</li>
                                <li>Ukuran max : 5MB</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{route('adminkelolapengumuman')}}" class="btn btn-secondary" type="button"
                    data-dismiss="modal">Kembali</a>
                <button type="submit" class="btn btn-primary" href="#">Tambah</button>
            </div>
        </form>
    </div>
    @endif

</div>

@endsection

@section('js')
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>

<script>
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
</script>
@endsection
