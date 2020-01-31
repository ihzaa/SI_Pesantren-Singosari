@extends('admin.template.all')
@section('title','Admin')
@section('Judul','Kelola Pembelajaran')

@section('css')
<link rel="stylesheet" href="/css/timelinecustom.css">

<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row text-center">
        <h1 class="heading-title">Tahun Ajaran {{$ta->nama}} Semester {{ucfirst($ta->semester)}} </h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-timeline">
                <div class="timeline">
                    <div class="timeline-icon"></div>
                    <div class="timeline-content">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <div class="row align-items-center  justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Mata Pelajaran</h6>
                                    <a title="Tambah " href="#" class="btn btn-sm btn-outline-dark" data-toggle="modal"
                                        data-target="#tambahModal" data-idta="{{$ta->id}}">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <p>Tabel mata kuliah yang ikut serta dalam semester ini</p>
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                                $i=1;
                                                ?>
                                            @foreach($ta->mata_pelajaran_tahun_ajaran as $t)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$t->mata_pelajaran->nama}}</td>
                                                <td>
                                                    <div class="row justify-content-center">
                                                        <a href="#" class="btn btn-danger btn-circle btn-sm"
                                                            title="Hapus" data-toggle="modal" data-target="#hapusModal"
                                                            data-id="{{$t->id}}"
                                                            data-nama="{{$t->mata_pelajaran->nama}}">
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
                    </div>
                </div>

                <div class="timeline">
                    <div class="timeline-icon"></div>
                    <div class="timeline-content right">
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Kelas</h6>
                            </div>
                            <div class="card-body">
                                The styling for this basic card example is created by using default Bootstrap utility
                                classes. By using utility classes, the style of the card component can be easily
                                modified with no need for any custom CSS!
                            </div>
                        </div>
                    </div>
                </div>

                <div class="timeline">
                    <div class="timeline-icon"></div>
                    <div class="timeline-content">
                        <span class="date">March 14, 2016</span>
                        <h4 class="title">Brand Building</h4>
                        <p class="description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vitae eleifend ex. Praesent
                            magna justo, bibendum id ante ut, vulputate tincidunt ipsum. Curabitur at rhoncus sem, eu
                            feugiat sapien. Duis in libero cursus, dapibus sem ac, ornare mauris. Cras nunc lectus,
                            porta quis metus vestibulum, pellentesque gravida erat.
                        </p>
                    </div>
                </div>

                <div class="timeline">
                    <div class="timeline-icon"></div>
                    <div class="timeline-content right">
                        <span class="date">March 16, 2016</span>
                        <h4 class="title">Responsive Design</h4>
                        <p class="description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vitae eleifend ex. Praesent
                            magna justo, bibendum id ante ut, vulputate tincidunt ipsum. Curabitur at rhoncus sem, eu
                            feugiat sapien. Duis in libero cursus, dapibus sem ac, ornare mauris. Cras nunc lectus,
                            porta quis metus vestibulum, pellentesque gravida erat.
                        </p>
                    </div>
                </div>
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
                <h5 class="modal-title" id="exampleModalLabel">Hapus Mata Pelajaran Berikut pada Semester Ini?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{route('adminhapusmatpeldita')}}" method="POST">
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

<!-- MODAL TAMBAH -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Mata Pelajaran</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="user" action="{{route('admin_tambah_mp_ta')}}" method="POST">
                    @csrf
                    <input type="hidden" id="id_ta" name="id_ta">
                    <div class="form-group row">
                        <div class="col">
                            <label>Mata Pelajaran</label>
                            <select name="mata_pelajaran" class="form-control">
                                @foreach(\App\mata_pelajaran::get() as $m)
                                <option value="{{$m->id}}">{{$m->nama}}</option>
                                @endforeach
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

@endsection

@section('js')
<script>
    $('#hapusModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that trigg  ered the modal
        var modal = $(this)

        modal.find('.modal-body #id').val(button.data('id'))
        modal.find('.modal-body #nama').val(button.data('nama'))
        })

    $('#tambahModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that trigg  ered the modal
        var modal = $(this)

        modal.find('.modal-body #id_ta').val(button.data('idta'))
        })
</script>
@endsection
