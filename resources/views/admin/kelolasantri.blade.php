@extends('admin.template.all')
@section('title','Admin')
@section('Judul','Kelola Santri')

@section('css')

<!-- Custom styles for this page -->
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

@endsection

@section('content')
<div class="card shadow mb-4">
  <div class="card-header py-3 align-items-center justify-content-between d-sm-flex">
    <h6 class="mb-0 font-weight-bold text-primary">Tabel Santri</h6>
    <div>
      <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#tambahModal">
        <span class="icon text-white-50">
          <i class="fa fa-plus"></i>
        </span>
        <span class="text">Tambah Santri Manual</span>
      </a>

      <a href="#" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#tambahModalFile">
        <span class="icon text-white-50">
          <i class="fa fa-plus"></i>
        </span>
        <span class="text">Tambah Santri Dengan File</span>
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
            <th>NIS</th>
            <th>Jenis Kelamin</th>
            <th>Tahun Masuk</th>
            <th>Nama Wali</th>
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
            <th>Nama Wali</th>
            <th>Action</th>
          </tr>
        </tfoot>
        <tbody>
          <?php
                  		$i = 1;
                  	?>
          @foreach($santri as $s)

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
            <td>{{str_limit($s->nama_wali,30)}}</td>
            <td>
              <a href="#" data-toggle="modal" data-target="#detailModal" class="btn btn-info btn-circle btn-sm"
                title="Detail dan Edit" data-nama="{{$s->nama}}" data-nis="{{$s->nis}}" data-tgl="{{$s->tanggal_lahir}}"
                data-tmpt="{{$s->tempat_lahir}}" data-telp="{{$s->telp}}" data-nwali="{{$s->nama_wali}}"
                data-twali="{{$s->telp_wali}}" data-alamat="{{$s->alamat}}" data-tm="{{$s->tahun_masuk}}"
                data-id="{{$s->id}}" data-jk="{{$s->jenis_kelamin}}">
                <i class="fas fa-user-edit text-light"></i>
              </a>

              <a href="#" data-toggle="modal" data-target="#hapusModal" class="btn btn-danger btn-circle btn-sm"
                title="Hapus" data-id="{{$s->id_user}}" data-nama="{{$s->nama}}" data-nis="{{$s->nis}}">
                <i class="fas fa-trash text-light"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>


<!-- MODAL DETAIL -->
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="user" action="{{route('admin_ubah_data_santri')}}" method="POST">
          @include('Form.formsantri_atas')
          <input type="number" id="nis" class="form-control" id="nis" placeholder="NIS" name="nis" required=""
            disabled="">
          @include('Form.formsantri_bawah')
      </div>
    </div>
  </div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Santri</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="user" action="{{route('admin_tambah_santri')}}" method="POST">
          @include('Form.formsantri_atas')
          <input type="number" id="nis" class="form-control" id="nis" placeholder="NIS" name="nis" required="">
          @include('Form.formsantri_bawah')
      </div>
    </div>
  </div>

<!-- MODAL MENU TAMBAH -->
<div class="modal fade" id="tambahModalFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Santri dengan File</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="user" action="{{route('admin_tambah_file_santri')}}" enctype="multipart/form-data" method="POST">
          @csrf
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile" name="file" required="">
            <label class="custom-file-label" for="customFile">Choose file</label>
          </div>
          <div class="row">
            <div class="col">
              <p><br>Syarat file yang dapat di upload : </p>
              <ul>
                <li>Ukuran maksimal 10MB</li>
                <li>Format .csv</li>
                <li>Urutan kolom sesuai contoh file <a href="{{route('exfilecsvsantri')}}"><i class="fas fa-download fa-sm text-primary"></i> Download contoh
                  file csv</a></li>
                <li>Penulisan tanggal lahir hh/mm/yyyy <strong>contoh:20/10/1998</strong> </li>
              </ul>


              <p><br><strong>NIS tidak dapat dirubah</strong></p>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger" href="#">Upload</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Hapus Akun?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="user" action="{{route('admin_hapus_santri')}}" method="POST">
          @csrf
          <input type="hidden" class="form-control" id="id" name="id">
          <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <label>Nama</label>
              <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama" disabled="">
            </div>
            <div class="col-sm-6">
              <label for="nis">NIS</label>
              <input type="number" id="nis" class="form-control" id="nis" placeholder="NIS" name="nis" disabled="">
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
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
  $('#detailModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that trigg  ered the modal
      var modal = $(this)

      modal.find('.modal-body #id').val(button.data('id'))
      modal.find('.modal-body #nama').val(button.data('nama'))
      modal.find('.modal-body #nis').val(button.data('nis'))
      modal.find('.modal-body #tahun_masuk').val(button.data('tm'))
      modal.find('.modal-body #nama_wali').val(button.data('nwali'))
      modal.find('.modal-body #jenis_kelamin').val(button.data('jk'))
      modal.find('.modal-body #telp_wali').val(button.data('twali'))
      modal.find('.modal-body #telp').val(button.data('telp'))
      modal.find('.modal-body #alamat').val(button.data('alamat'))
      modal.find('.modal-body #tempat_lahir').val(button.data('tmpt'))
      modal.find('.modal-body #tanggal_lahir').val(button.data('tgl'))
      modal.find('.modal-body #alamat').val(button.data('alamat'))

      })

    $('#hapusModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that trigg  ered the modal
      var modal = $(this)

      modal.find('.modal-body #id').val(button.data('id'))
      modal.find('.modal-body #nama').val(button.data('nama'))
      modal.find('.modal-body #nis').val(button.data('nis'))
      })

    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endsection
