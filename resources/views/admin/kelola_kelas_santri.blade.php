@extends('admin.template.all')

@section('title','Admin')
@section('Judul','Kelola Kelas')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- Custom styles for this page -->
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<?php
    $kls = \App\tahun_ajaran::where('id',$id_ta)->first();
?>
<a href='/4dm1n/kelola-pembelajaran/{{$kls->id}}-{{$kls->nama}}' class="btn btn-sm btn-outline-info mb-2">
    <span class="text">Kembali</span>
</a>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link "
            href="/4dm1n/kelola-pembelajaran/{{$id_ta}}/kelola-kelas/{{$id_kls}}/mata-pelajaran">Pengajar dan Mata
            Pelajaran</a>
    </li>
    <li class="nav-item">
        <a class="nav-link active" href="#">Santri</a>
    </li>
</ul>
<div class="card shadow mb-4">
    <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
        <h6 class="mb-0 font-weight-bold text-primary">Kelas {{\App\kelas::where('id',$id_kls)->pluck('nama')[0]}}</h6>
        <input type="hidden" name="id_kls" value="{{$id_kls}}">
        <div>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Jenis Kelamin</th>
                        <th>Tahun Masuk</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIS</th>
                        <th>Jenis Kelamin</th>
                        <th>Tahun Masuk</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                  		$i = 1;
                  	?>
                    @foreach($snt as $s)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{str_limit($s->nama,30)}}</td>
                        <td>{{$s->nis}}</td>
                        <td>
                            @if($s->jenis_kelamin == 'l')
                            Laki - Laki
                            @else
                            Perempuan
                            @endif
                        </td>
                        <td>{{$s->tahun_masuk}}</td>
                        <td>
                            <div class="row justify-content-center">
                                <input type="hidden" name="id_santri{{$i}}" value="{{$s->id}}">
                                @if(\App\data_per_kelas::where('id_santri',$s->id)->where('id_kelas',$id_kls)->count()
                                == 0)
                                <button id="btn-tambah{{$i}}" type="button"
                                    class="btn btn-outline-info btn-sm btn-tambah"
                                    data-target="{{$i}}">Tambahkan</button>
                                <button id="btn-keluar{{$i}}" type="button"
                                    class="btn btn-outline-danger btn-sm btn-keluar" style="display: none;"
                                    data-target="{{$i}}">Keluarkan</button>
                                <button class="btn btn-outline-primary btn-sm btn-loading" id="btn-ldg{{$i}}"
                                    type="submit" style="display: none;">
                                    <span class="spinner-border spinner-border-sm"></span>
                                </button>
                                @else
                                <button id="btn-tambah{{$i}}" type="button"
                                    class="btn btn-outline-info btn-sm btn-tambah" data-target="{{$s->id}}"
                                    style="display: none;">Tambahkan</button>
                                <button id="btn-keluar{{$i}}" type="button"
                                    class="btn btn-outline-danger btn-sm btn-keluar"
                                    data-target="{{$s->id}}">Keluarkan</button>
                                <button class="btn btn-outline-primary btn-sm btn-loading" id="btn-ldg{{$i}}"
                                    type="submit" style="display: none;">
                                    <span class="spinner-border spinner-border-sm"></span>
                                </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
    $('.btn-tambah').click(function(){
        $(this).next().next().toggle();
        $(this).toggle();

        var tambol = $(this); //ga sengaja typo

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '{{route('tambah_santri_ke_kelas')}}',
            data: {
                'id_santri' : $('input[name=id_santri'+$(this).data('target')+']').val(),
                'id_kls' : $('input[name=id_kls]').val()
            },
            success: function(data){
                keKeluar(tambol);
            },
            error: function(data){
                alert('fail');
            }
        });

    });


    $('.btn-keluar').click(function(){
        $(this).next().toggle();
        $(this).toggle();

        var tambol2 = $(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'post',
            url: '{{route('keluar_santri_santri_kelas')}}',
            data: {
                'id_santri' : $('input[name=id_santri'+$(this).data('target')+']').val(),
                'id_kls' : $('input[name=id_kls]').val()
            },
            success: function(data){
                keTambah(tambol2);
            },
            error: function(data){
                alert('fail');
            }
        });
    });

    function keTambah(j){
        j.prev().toggle();
        j.next().hide();
    }

    function keKeluar(i){
        i.next().toggle();
        i.next().next().hide();
    }

</script>
@endsection
