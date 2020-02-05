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
    <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
        <h6 class="mb-0 font-weight-bold text-primary">Pengumuman</h6>
        <div>
            <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#tambahModal">
                <span class="icon text-white-50">
                    <i class="fa fa-plus"></i>
                </span>
                <span class="text">Tambah Pengumuman</span>
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Isi</th>
                        <th>Foto</th>
                        <th>Dibuat</th>
                        <th>Proproitas</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Isi</th>
                        <th>Foto</th>
                        <th>Dibuat</th>
                        <th>Proproitas</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                        $i = 1;
                    ?>
                    @foreach($p as $s)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$s->judul}}</td>
                        <td>{{str_limit($s->isi,30)}}</td>
                        <td style="width: 150px;">
                            <img src="/{{$s->foto}}" alt="fotonya" class="img-fluid">
                        </td>
                        <td>{{$s->dibuat}}</td>
                        <td>
                            <div class="row justify-content-center">
                                @if($s->status == 'n')
                                <button type="button" id="btnprior{{$i}}" class="btn btn-outline-info btn-sm btn-prior"
                                    data-target="{{$i}}">Prioritaskan</button>
                                <button type="button" id="btnnonprior{{$i}}"
                                    class="btn btn-outline-danger btn-sm btn-nonprior" style="display: none;"
                                    data-target="{{$i}}">Non-Prioritas</button>
                                <button id="btnldng{{$i}}" class="btn btn-outline-primary btn-sm btn-loading"
                                    type="submit" style="display: none;">
                                    <span class="spinner-border spinner-border-sm"></span>
                                </button>
                                <input type="hidden" id="idnya" name="id{{$i}}" value="{{$s->id}}">
                                @else
                                <button type="button" id="btnprior{{$i}}" class="btn btn-outline-info btn-sm btn-prior"
                                    data-target="{{$i}}" style="display: none;">Prioritaskan</button>
                                <button type="button" id="btnnonprior{{$i}}"
                                    class="btn btn-outline-danger btn-sm btn-nonprior"
                                    data-target="{{$i}}">Non-Prioritas</button>
                                <button id="btnldng{{$i}}" class="btn btn-outline-primary btn-sm btn-loading"
                                    type="submit" style="display: none;">
                                    <span class="spinner-border spinner-border-sm"></span>
                                </button>
                                <input type="hidden" id="idnya" name="id{{$i}}" value="{{$s->id}}">
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

@endsection

@section('js')
<script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('js/demo/datatables-demo.js')}}"></script>


@endsection
