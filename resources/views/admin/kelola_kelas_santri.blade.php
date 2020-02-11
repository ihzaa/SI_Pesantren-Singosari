@extends('admin.template.all')

@section('title','Admin')
@section('Judul','Kelola Kelas')
@section('content')
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
                    @foreach(\App\santri::get() as $s)
                    @if(in_array((array)\App\data_per_kelas::where('id_santri',$s->id)->pluck('id_kelas'),$arr) )
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

                            </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

@section('js')
<script>

</script>
@endsection
