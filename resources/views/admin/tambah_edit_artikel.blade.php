@extends('admin.template.all')

@section('title','Admin')
@section('Judul','Kelola Artikel')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
            @foreach($artikel->file_artikel as $fa)
            <div class="form-group row ml-2">
                <a href="{{URL::to('/'.$fa->path)}}"><i class="fas fa-download fa-sm text-primary"></i>{{$fa->nama}}</a>
                <a type="submit" class="apus_file ml-2 text-danger" title="HAPUS" data-target="{{$fa->id}}"><i
                        class="fas fa-minus-circle"></i></a>
            </div>
            @endforeach
            <div id="tambah_input">
            </div>
            <div class="form-group">
                <div class="d-flex justify-content-center">
                    <a href="#" class="btn btn-sm btn-primary add_button btn-icon-split" title="Tambah">
                        <span class="icon">
                            <i class="fas fa-plus-square"></i>
                        </span>
                        <span class="text">Tambah Inputan</span>
                    </a>
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
            <div id="tambah_input">
            </div>

            <div class="form-group">
                <div class="d-flex justify-content-center">
                    <a href="#" class="btn btn-sm btn-primary add_button btn-icon-split" title="Tambah">
                        <span class="icon">
                            <i class="fas fa-plus-square"></i>
                        </span>
                        <span class="text">Tambah Inputan</span>
                    </a>
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

$('.apus_file').click(function(){
    var a = $(this);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $.ajax({
            type: 'post',
            url: '{{route('hapusFileArtikel')}}',
            data: {
                'id':  $(this).data('target')
            },
            success: function(data) {
                akt(a);
            },
            error: function(data){
                alert("fail");
            }
    });
    });

    function akt(a){
        a.parent().remove();
    }
</script>

<script type="text/javascript">
    $(document).ready(function(){
        //var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('#tambah_input'); //Input field wrapper
        var fieldHTML = '<div class="form-group d-flex justify-content-center row"><div class="col-8"><input type="file" class="form-control ml-2" id="customFile" name="file[]" required=""></div><a href="" class="remove_button mt-2"><i class="fas fa-minus-circle"></i></a></div>'; //New input field html
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            // if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            // }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });
</script>
@endsection
