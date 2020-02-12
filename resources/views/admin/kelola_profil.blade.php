@extends('admin.template.all')

@section('title','Admin')
@section('Judul','Kelola Profil')

@section('content')
<div class="row d-flex justify-content-center">
    <div class="col-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ubah Username</h6>
            </div>
            <div class="card-body">
                <form action="{{route('ubah_username')}}" method="POST">
                    @csrf
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="width:175px;" id="basic-addon1">Username Lama</span>
                        </div>
                        <input type="text" class="form-control form-control-user" placeholder="Username" disabled=""
                            value="{{Session::get('adminlogin')[0]->nama}}">
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="width:175px;" id="basic-addon1">Username Baru </span>
                        </div>
                        <input type="text" class="form-control form-control-user" name="username" placeholder="Username"
                            required="">
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="width:175px;" id="basic-addon1">Konfirmasi
                                Password</span>
                        </div>
                        <input type="password" class="form-control form-control-user" name="password"
                            placeholder="Username" required="">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Ubah Username
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row  d-flex justify-content-center">
    <div class="col-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ubah Password</h6>
            </div>
            <div class="card-body">
                <form action="{{route('ubah_password')}}" method="POST" id="form_pass" onsubmit="cek()">
                    @csrf
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="width:225px;" id="basic-addon1">Password Lama</span>
                        </div>
                        <input type="text" class="form-control form-control-user" name="pass_lama"
                            placeholder="Password Lama" id="psl" required="">
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="width:225px;" id="basic-addon1">Password Baru</span>
                        </div>
                        <input type="password" class="form-control form-control-user" name="pass1"
                            placeholder="Password Baru" id="ps1" required="">
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" style="width:225px;" id="basic-addon1">Konfirmasi
                                Password Baru</span>
                        </div>
                        <input type="password" class="form-control form-control-user" name="pass2"
                            placeholder="Konfirmasi Password Baru" id="ps2" required="">
                    </div>

                    <div class="alert alert-danger alert-dismissible fade show text-center" id="passgasama"
                        style="display: none;">
                        Konfirmasi Password Tidak Sesuai !!
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Ubah Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function cek(){
        var ps1 = document.getElementById('ps1').value;
        var ps2 = document.getElementById('ps2').value;
        if(ps1 != ps2){
            document.getElementById('passgasama').style.display="block";
            event.preventDefault();
            return false;
        }
        return true;
    }
</script>
@endsection
