@extends('admin.template.all')

@section('title','Admin')
@section('Judul','Kelola Artikel')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
@endsection

@section('content')

@if(request()->is('4dm1n/kelola-artikel/edit/*'))
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Artikel</h6>
    </div>
    <div class="card-body">
        <form class="user" action="{{route('editArtikel')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{$artikel->id}}" name="id" id="id">
            <div class="form-group row">
                <div class="col">
                    <label>Nama</label>
                    <input type="text" class="form-control" value="{{$artikel->nama}}" placeholder="Nama" id="nama"
                        name="nama" required="">
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <label>Content</label>
                    <textarea id="summernoteEdit" class="form-control" name="content" required=""></textarea>
                </div>
            </div>
            <hr>
            <a class="btn btn-secondary" type="button" href="{{route('kelola_artikel')}}">Kembali</a>
            <button type="submit" class="btn btn-primary" href="#">Simpan</button>
        </form>
    </div>
</div>
@else
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Artikel</h6>
    </div>
    <div class="card-body">
        <form class="user" action="{{route('storeArtikel')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="col">
                    <label>Nama</label>
                    <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama" required="">
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <label>Content</label>
                    <textarea id="summernote" class="form-control" name="content" required=""></textarea>
                </div>
            </div>
            <hr>
            <a class="btn btn-secondary" type="button" href="{{route('kelola_artikel')}}">Kembali</a>
            <button type="submit" class="btn btn-primary" href="#">Tambah</button>
        </form>
    </div>
</div>
@endif
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script>
<script>
    @if(request()->is('4dm1n/kelola-artikel/edit/*'))
    $(document).ready( function() {
      var content = {!! json_encode($artikel->content) !!};
      $('#summernoteEdit').summernote('code', content);
    });
@else
    $(document).ready(function() {
        $('#summernote').summernote();
    });
@endif
</script>
@endsection
