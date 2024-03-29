<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Response;
use \App\santri;
use \App\artikel;
use \App\gambarArtikel;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Session::get('adminlogin'))
            return view('auth.loginadmin');
        return redirect('/4dm1n/');
    }

    public function cek(Request $request)
    {
        $user = \App\user::where('username', $request->username)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                if ($user->role == 1) {
                    Session::put('adminlogin', $user->admin);
                    return redirect('/4dm1n/');
                }
            }
            Session::flash('pesan', 'Username atau Password Salah');
            return redirect('/login');
        }
        Session::flash('pesan', 'Username atau Password Salah');
        return redirect('/4dm1n/login');
    }

    public function adminidx()
    {
        return view('admin.index');
    }

    public function kelola_profil()
    {
        $pass_lama = \App\user::where('id', Session::get('adminlogin')[0]->id_user)->pluck('password');
        return view('admin.kelola_profil', compact('pass_lama'));
    }

    public function ubah_username(Request $request)
    {
        if (\App\user::where('username', $request->username)->count() != 0) {
            Session::flash('color', 'alert-danger');
            Session::flash('pesan', 'Username Sudah Digunakan');
            return back();
        }

        $user = \App\user::where('id', Session::get('adminlogin')[0]->id_user)->first();
        if (Hash::check($request->password, $user->password)) {

            \App\admin::where('id', Session::get('adminlogin')[0]->id)->update([
                'nama' => $request->username
            ]);

            \App\user::where('id', Session::get('adminlogin')[0]->id_user)->update([
                'username' => $request->username
            ]);

            Session::flush();
            Session::flash('pesan', 'Username Berhasil Diubah Silahkan Login Kembali dengan Username Baru');
            return redirect('/4dm1n/login');
        } else {
            Session::flash('color', 'alert-danger');
            Session::flash('pesan', 'Konfirmasi Password Salah');
            return back();
        }
    }

    public function ubah_password(Request $request)
    {
        $user = \App\user::where('id', Session::get('adminlogin')[0]->id_user)->first();
        if (Hash::check($request->pass_lama, $user->password)) {
            \App\user::where('id', Session::get('adminlogin')[0]->id_user)->update([
                'password' => bcrypt($request->pass1)
            ]);

            Session::flush();
            Session::flash('pesan', 'Password Berhasil Diubah Silahkan Login Kembali dengan Password Baru');
            return redirect('/4dm1n/login');
        } else {
            Session::flash('color', 'alert-danger');
            Session::flash('pesan', 'Password Lama Salah !!');
            return back();
        }
    }

    public function adminkelolasantri()
    {
        $santri = \App\santri::get();
        return view('admin.kelolasantri', compact('santri'));
    }

    public function changedatasantri(Request $request)
    {
        $validatedData = Validator::make(request()->all(), [
            'nama' => 'required|max:255',
            'tahun_masuk' => 'required|max:4',
            'nama_wali' => 'required|max:255',
            'telp_wali' => 'required|max:255',
            'telp' => 'required',
            'alamat' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255|date',
            'jenis_kelamin' => 'required|max:1'
        ]);

        if ($validatedData->fails()) {
            Session::flash('color', 'alert-danger');
            Session::flash('pesan', 'Format data salah!');
            return redirect('/4dm1n/kelola-santri');
        }

        santri::where('id', $request->id)->update([
            'nama' => $request->nama,
            'tahun_masuk' => $request->tahun_masuk,
            'nama_wali' => $request->nama_wali,
            'telp_wali' => $request->telp_wali,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin
        ]);
        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil Merubah Data');
        return redirect('/4dm1n/kelola-santri');
    }

    public function tambahsantri(Request $request)
    {
        $validatedData = Validator::make(request()->all(), [
            'nama' => 'required|max:255',
            'nis' => 'required',
            'tahun_masuk' => 'required|max:4',
            'nama_wali' => 'required|max:255',
            'telp_wali' => 'required|max:255',
            'telp' => 'required',
            'alamat' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255|date',
            'jenis_kelamin' => 'required|max:1'
        ]);

        if ($validatedData->fails()) {
            Session::flash('color', 'alert-danger');
            Session::flash('pesan', 'Format data salah!');
            return redirect('/4dm1n/kelola-santri');
        }

        $ada = \App\user::where('username', $request->nis)->get();
        if (count($ada) > 0) {
            Session::flash('color', 'alert-danger');
            Session::flash('pesan', 'NIS Sudah Digunakan Data Tidak Ditambahkan');
            return redirect('/4dm1n/kelola-santri');
        }
        \App\user::create([
            'username' => $request->nis,
            'role' => 3
        ]);
        DB::table('santri')->insert([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'tahun_masuk' => $request->tahun_masuk,
            'nama_wali' => $request->nama_wali,
            'telp_wali' => $request->telp_wali,
            'telp' => $request->telp,
            'alamat' => $request->alamat,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'id_user' => \App\user::where('username', $request->nis)->pluck('id')[0]
        ]);
        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil Menambahkan Data');
        return redirect('/4dm1n/kelola-santri');
    }

    public function hapussantri(Request $request)
    {
        \App\user::where('id', $request->id)->delete();
        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil Menghapus Data');
        return redirect('/4dm1n/kelola-santri');
    }

    public function tambahfilesantri(Request $request)
    {

        // $this->validate($request, [
        //     'file'  => 'required|mimes:csv|max:8048'
        // ]);
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);
        $file = $request->file('file');
        // File Details
        $filename = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $tempPath = $file->getRealPath();
        $fileSize = $file->getSize();
        $mimeType = $file->getMimeType();

        // Valid File Extensions
        $valid_extension = array("csv");

        // 2MB in Bytes
        $maxFileSize = 2097152;

        // Check file extension
        if (in_array(strtolower($extension), $valid_extension)) {

            // Check file size
            if ($fileSize <= $maxFileSize) {

                // File upload location
                $location = 'uploads';

                // Upload file
                $file->move($location, $filename);

                // Import CSV to Database
                $filepath = $location . "/" . $filename;

                // Reading file
                $file = fopen($filepath, "r");

                $importData_arr = array();
                $pertama = TRUE;
                $i = 0;
                $theRightColumn = [
                    'no', 'nis', 'nama', 'jenis kelamin - l atau p', 'tempat lahir', 'tanggal lahir - hh/mm/tttt',
                    'telp', 'alamat', 'tahun masuk', 'nama wali', 'telp wali'
                ];
                while (($filedata = fgetcsv($file, 1000, ';')) !== FALSE) {
                    $num = count($filedata);

                    // Skip first row (Remove below comment if you want to skip the first row)
                    if ($pertama) {
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        if (array_diff($theRightColumn, $importData_arr[$i])) {
                            Session::flash('color', 'alert-danger');
                            Session::flash('pesan', 'Kolom tidak sesuai dengan contoh file');
                            return back();
                        }
                    }
                    for ($c = 0; $c < $num && !$pertama; $c++) {
                        if ($c == 5) {
                            $temp = explode("/", $filedata[5]);
                            $importData_arr[$i][] = "$temp[2]-$temp[1]-$temp[0]";
                            continue;
                        }
                        $importData_arr[$i][] = $filedata[$c];
                    }
                    if ($pertama) {
                        $pertama = FALSE;
                    }
                    $i++;
                }
                fclose($file);
                File::delete($location . "/" . $filename);
                $i = 0;
                // Insert to MySQL database
                foreach ($importData_arr as $importData) {
                    #################################################################################################
                    $ada = \App\user::where('username', $importData[1])->get();
                    if (count($ada) > 0) {
                        continue;
                    }
                    \App\user::create([
                        'username' => $importData[1],
                        'role' => 3
                    ]);
                    DB::table('santri')->insert([
                        'nama' => $importData[2],
                        'nis' => $importData[1],
                        'tahun_masuk' => $importData[8],
                        'nama_wali' => $importData[9],
                        'telp_wali' => '0' . $importData[10],
                        'telp' => '0' . $importData[6],
                        'alamat' => $importData[7],
                        'tempat_lahir' => $importData[4],
                        'tanggal_lahir' => $importData[5],
                        'jenis_kelamin' => $importData[3],
                        'id_user' => \App\user::where('username', $importData[1])->pluck('id')[0]
                    ]);
                    $i++;
                    ###########################################################################
                }

                Session::flash('color', 'alert-success');
                Session::flash('pesan', 'Berhasil Menambahkan ' . $i . ' data');
            } else {
                Session::flash('color', 'alert-danger');
                Session::flash('pesan', 'File too large. File must be less than 2MB.');
            }
        } else {
            Session::flash('color', 'alert-danger');
            Session::flash('pengar', 'Invalid File Extension.');
        }
        return redirect('4dm1n/kelola-santri');
    }

    public function downloadexcsvsantri()
    {
        return Response::download(public_path() . '/Downloadable/Contoh File CSV Santri1.csv', 'Contoh File CSV Santri.csv');
    }


    public function adminkelolapengajar()
    {
        $pengajar = \App\pengajar::get();
        return view('admin.kelolapengajar', compact('pengajar'));
    }

    public function changedatapengajar(Request $request)
    {
        $validatedData = Validator::make(request()->all(), [
            'nama' => 'required|max:255',
            'telp' => 'required',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255|date',
            'jenis_kelamin' => 'required|max:1',
            'email' => 'required|email'
        ]);

        if ($validatedData->fails()) {
            Session::flash('color', 'alert-danger');
            Session::flash('pesan', 'Format data salah!');
            return redirect('/4dm1n/kelola-pengajar');
        }


        \App\pengajar::where('id', $request->id)->update([
            'nama' => $request->nama,
            'telp' => $request->telp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email
        ]);
        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil Merubah Data');
        return redirect('/4dm1n/kelola-pengajar');
    }

    public function tambahpengajar(Request $request)
    {
        $validatedData = Validator::make(request()->all(), [
            'nama' => 'required|max:255',
            'telp' => 'required',
            'tempat_lahir' => 'required|max:255',
            'tanggal_lahir' => 'required|max:255|date',
            'jenis_kelamin' => 'required|max:1',
            'email' => 'required|email'
        ]);

        if ($validatedData->fails()) {
            Session::flash('color', 'alert-danger');
            Session::flash('pesan',  'Format data salah!');
            return redirect('/4dm1n/kelola-pengajar');
        }
        $ada = \App\user::where('username', $request->nip)->get();
        if (count($ada) > 0) {
            Session::flash('color', 'alert-danger');
            Session::flash('pesan', 'NIP Sudah Digunakan Data Tidak Ditambahkan');
            return redirect('/4dm1n/kelola-pengajar');
        }
        \App\user::create([
            'username' => $request->nip,
            'role' => 2
        ]);
        DB::table('pengajar')->insert([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'telp' => $request->telp,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email,
            'id_user' => \App\user::where('username', $request->nip)->pluck('id')[0]
        ]);
        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil Menambahkan Data');
        return redirect('/4dm1n/kelola-pengajar');
    }

    public function tambahfilepengajar(Request $request)
    {
        if ($request->file != null) {

            // $this->validate($request, [
            //     'file'  => 'required|mimes:csv|max:10048'
            // ]);
            $request->validate([
                'file' => 'required|mimes:csv,txt',
            ]);
            $file = $request->file('file');

            // File Details
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();

            // Valid File Extensions
            $valid_extension = array("csv");

            // 10MB in Bytes
            $maxFileSize = 2097152;

            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {

                // Check file size
                if ($fileSize <= $maxFileSize) {

                    // File upload location
                    $location = 'uploads';

                    // Upload file
                    $file->move($location, $filename);

                    // Import CSV to Database
                    $filepath = $location . "/" . $filename;

                    // Reading file
                    $file = fopen($filepath, "r");

                    $importData_arr = array();
                    $pertama = TRUE;
                    $i = 0;
                    $theRightColumn = [
                        'no', 'nip', 'nama', 'telepon', 'tempat lahir',
                        'tanggal lahir - hh/mm/tttt', 'jenis kelamin - l atau p', 'email'
                    ];
                    while (($filedata = fgetcsv($file, 1000, ";")) !== FALSE) {
                        $num = count($filedata);

                        // Skip first row (Remove below comment if you want to skip the first row)
                        if ($pertama) {
                            for ($c = 0; $c < $num; $c++) {
                                $importData_arr[$i][] = $filedata[$c];
                            }
                            if (array_diff($theRightColumn, $importData_arr[$i])) {
                                Session::flash('color', 'alert-danger');
                                Session::flash('pesan', 'Kolom tidak sesuai dengan contoh file');
                                return redirect('/4dm1n/kelola-pengajar');
                            }
                        }
                        for ($c = 0; $c < $num && !$pertama; $c++) {
                            if ($c == 5) {
                                $temp = explode("/", $filedata[5]);
                                $importData_arr[$i][] = "$temp[2]-$temp[1]-$temp[0]";
                                continue;
                            }
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        if ($pertama) {
                            $pertama = false;
                        }
                        $i++;
                    }
                    fclose($file);
                    File::delete($location . "/" . $filename);
                    $i = 0;
                    // Insert to MySQL database
                    foreach ($importData_arr as $importData) {
                        #################################################################################################
                        $ada = \App\user::where('username', $importData[1])->get();
                        if (count($ada) > 0) {
                            continue;
                        }
                        \App\user::create([
                            'username' => $importData[1],
                            'role' => 3
                        ]);
                        DB::table('pengajar')->insert([
                            'nama' => $importData[2],
                            'nip' => $importData[1],
                            'telp' => '0' . $importData[3],
                            'tempat_lahir' => $importData[4],
                            'tanggal_lahir' => $importData[5],
                            'jenis_kelamin' => $importData[6],
                            'email' => $importData[7],
                            'id_user' => \App\user::where('username', $importData[1])->pluck('id')[0]
                        ]);
                        $i++;
                        ###########################################################################
                    }

                    Session::flash('color', 'alert-success');
                    Session::flash('pesan', 'Berhasil Menambahkan ' . $i . ' data');
                } else {
                    Session::flash('color', 'alert-danger');
                    Session::flash('pesan', 'File too large. File must be less than 10MB.');
                }
            } else {
                Session::flash('color', 'alert-danger');
                Session::flash('pengar', 'Invalid File Extension.');
            }
        }
        return redirect('4dm1n/kelola-pengajar');
    }

    public function hapuspengajar(Request $request)
    {
        \App\user::where('id', $request->id)->delete();
        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil Menghapus Data');
        return redirect('/4dm1n/kelola-pengajar');
    }

    public function downloadexcsvpengajar()
    {
        return Response::download(public_path() . '/Downloadable/Contoh File CSV pengajar1.csv', 'Contoh File CSV pengajar.csv');
    }

    public function adminkelolapembelajaran()
    {
        $ta = \App\tahun_ajaran::get();
        return view('admin.kelolapembelajaran', compact('ta'));
    }

    public function admin_tambah_tahun_ajaran(Request $request)
    {
        DB::table('tahun_ajaran')->insert([
            'nama' => $request->nama,
            'semester' => $request->semester
        ]);
        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil menambahkan tahun ajaran');
        return redirect('/4dm1n/kelola-pembelajaran');
    }

    public function admin_edit_tahun_ajaran(Request $request)
    {
        \App\tahun_ajaran::where('id', $request->id)->update([
            'nama' => $request->nama,
            'semester' => $request->semester
        ]);
        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil merubah tahun ajaran');
        return redirect('/4dm1n/kelola-pembelajaran');
    }

    public function admin_hapus_tahun_ajaran(Request $request)
    {
        \App\tahun_ajaran::where('id', $request->id)->delete();
        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil menghapus tahun ajaran');
        return redirect('/4dm1n/kelola-pembelajaran');
    }

    public function timeline_tahuna_ajaran($id)
    {
        $ta = \App\tahun_ajaran::where('id', $id)->first();
        return view('admin.kelolatahunajaran', compact('ta'));
    }

    public function adminkelolamatpel()
    {

        $mp = \App\mata_pelajaran::get();
        return view('admin.kelolamatpel', compact('mp'));
    }

    public function admintambahmatpel(Request $request)
    {
        DB::table('mata_pelajaran')->insert([
            'nama' => $request->nama
        ]);

        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil menambah mata pelajaran');
        return redirect('/4dm1n/kelola-matpel');
    }

    public function admineditmatpel(Request $request)
    {
        \App\mata_pelajaran::where('id', $request->id)->update([
            'nama' => $request->nama
        ]);
        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil merubah mata pelajaran');
        return redirect('/4dm1n/kelola-matpel');
    }

    public function adminhapusmatpel(Request $request)
    {
        \App\mata_pelajaran::where('id', $request->id)->delete();
        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil menghapus mata pelajaran');
        return redirect('/4dm1n/kelola-matpel');
    }

    public function adminhapusmatpeldita(Request $request)
    {
        \App\mata_pelajaran_tahun_ajaran::where('id', $request->id)->delete();
        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil menghapus mata pelajaran');
        return back();
    }

    public function admin_tambah_mp_ta(Request $request)
    {
        $cek = \App\mata_pelajaran_tahun_ajaran::where('id_tahun_ajaran', $request->id_ta)->where('id_mata_pelajaran', $request->mata_pelajaran)->get();

        if (count($cek) != 0) {
            Session::flash('color', 'alert-danger');
            Session::flash('pesan', 'Mata pelajaran sudah termasuk di semester ini');
            return back();
        }

        DB::table('mata_pelajaran_tahun_ajaran')->insert([
            'id_tahun_ajaran' => $request->id_ta,
            'id_mata_pelajaran' => $request->mata_pelajaran
        ]);
        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil menambah mata pelajaran');
        return back();
    }

    public function adminkelolacarousel()
    {
        $cl = \App\carousel::get();
        return view('admin.kelolacarousel', compact('cl'));
    }

    public function admintambahcarousel(Request $request)
    {
        $this->validate($request, [
            'file'  => 'required|image|mimes:jpg,png,jpeg|max:5120'
        ]);


        $foto = DB::table('carousel')->insertGetId([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);

        if ($request->file != null) {
            $file = $request->file('file');
            $nama_file = $foto . '.' . $file->getClientOriginalExtension();
            $tujuan_upload = 'carousel/';
            $lengkap = $tujuan_upload . $nama_file;
            $file->move($tujuan_upload, $nama_file);

            \App\carousel::where('id', $foto)->update([
                'foto' => $lengkap
            ]);

            Session::flash('color', 'alert-success');
            Session::flash('pesan', 'Berhasil menambah carousel');
            return back();
        }
    }

    public function admineditcarousel(Request $request)
    {
        \App\carousel::where('id', $request->id)->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi
        ]);

        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil merubah carousel');
        return back();
    }

    public function adminhapuscarousel(Request $request)
    {
        File::delete(\App\carousel::where('id', $request->id)->first()->foto);
        \App\carousel::where('id', $request->id)->delete();
        Session::flash('color', 'alert-danger');
        Session::flash('pesan', 'Berhasil menghapus carousel');
        return back();
    }

    public function adminaktifcarousel(Request $request)
    {
        \App\carousel::where('id', $request->idcar)->update([
            'status' => 'aktif'
        ]);
        return 1;
    }

    public function adminnonaktifcarousel(Request $request)
    {
        \App\carousel::where('id', $request->idcar)->update([
            'status' => 'nonaktif'
        ]);
        return 1;
    }

    public function adminaktifpembelajaran(Request $request)
    {
        $count = \App\tahun_ajaran::where('status', 'aktif')->get();
        // return count($count) == '0' .'asd';
        if (count($count) == '0') {
            \App\tahun_ajaran::where('id', $request->idcar)->update([
                'status' => 'aktif'
            ]);
            return 1;
        } else {
            return 0;
        }
    }

    public function adminnonaktifpembelajaran(Request $request)
    {
        \App\tahun_ajaran::where('id', $request->idcar)->update([
            'status' => 'nonaktif'
        ]);
        return 1;
    }

    public function adminkeloladonasi()
    {
        $d = \App\donasi_masuk::get();
        return view('admin.keloladonasi', compact('d'));
    }

    public function adminedittotaldonasi(Request $request)
    {
        \App\donasi::where('id', 1)->update([
            'Target' => $request->target
        ]);
        return 1;
    }

    public function admintambahdonasimasuk(Request $request)
    {
        DB::table('donasi_masuk')->insert([
            'nama' => $request->rek,
            'nominal' => $request->nominal
        ]);
        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil menambah donasi');
        return back();
    }

    public function admineditdonasimasuk(Request $request)
    {
        \App\donasi_masuk::where('id', $request->id)->update([
            'nama' => $request->rek,
            'nominal' => $request->nominal
        ]);
        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil merubah carousel');
        return back();
    }

    public function adminhapusdonasimasuk(Request $request)
    {
        \App\donasi_masuk::where('id', $request->id)->delete();
        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil hapus carousel');
        return back();
    }

    public function simpankolokkiridonasi(Request $request)
    {
        if ($request->file == null) {
            \App\donasi::where('id', 1)->update([
                'judul' => $request->judul,
                'deskripsi' => $request->desc
            ]);
            return 1;
        } else if ($request->file != null) {
            $validation = Validator::make($request->all(), [
                'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120'
            ]);
            if (!$validation->passes()) {
                return 2;
            }
            $file = $request->file('file');
            $nama_file =  'foto' . date('H-i-s', time()) . '.' . $file->getClientOriginalExtension();
            $tujuan_upload = 'donasi/';
            $lengkap = $tujuan_upload . $nama_file;
            $file->move($tujuan_upload, $nama_file);
            File::delete(substr(\App\donasi::where('id', 1)->first()->foto, 1));
            \App\donasi::where('id', 1)->update([
                'judul' => $request->judul,
                'deskripsi' => $request->desc,
                'foto' => '/' . $lengkap
            ]);
            return 1;
        }
    }

    public function adminkelolapengumuman()
    {
        $p = \App\pengumuman::get();
        return view('admin.kelolapengumuman', compact('p'));
    }

    public function admintambahpengumuman(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        $id = DB::table('pengumuman')->insertGetId([
            'judul' => $request->judul,
            'isi' => $request->isi
        ]);

        $file = $request->file('file');
        $nama_file =  $id . '.' . $file->getClientOriginalExtension();
        $tujuan_upload = 'pengumuman/';
        $lengkap = $tujuan_upload . $nama_file;
        $file->move($tujuan_upload, $nama_file);

        \App\pengumuman::where('id', $id)->update([
            'foto' => $lengkap
        ]);
        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil Menambah Pengumuman');
        return redirect('/4dm1n/kelola-pengumuman');
    }

    public function adminmemprioritaskan(Request $request)
    {
        $count = \App\pengumuman::where('prioritas', 'y')->count();
        if ($count < 4) {
            \App\pengumuman::where('id', $request->id)->update([
                'prioritas' => 'y'
            ]);
            return 1;
        } else {
            return 2;
        }
    }

    public function adminnonprioritaskan(Request $request)
    {
        \App\pengumuman::where('id', $request->id)->update([
            'prioritas' => 'n'
        ]);
        return 1;
    }

    public function adminhapuspengumuman(Request $request)
    {
        File::delete(\App\pengumuman::where('id', $request->id)->pluck('foto')[0]);
        \App\pengumuman::where('id', $request->id)->delete();
        Session::flash('color', 'alert-danger');
        Session::flash('pesan', 'Berhasil Hapus Pengumuman');
        return back();
    }


    public function admineditpengumuman($id, $judul)
    {
        $p = \App\pengumuman::where('id', $id)->first();
        return view('admin.tambahpengumuman', compact('p'));
    }

    public function admineditpengumumanya(Request $request)
    {
        if ($request->file != null) {
            $request->validate([
                'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120'
            ]);

            $file = $request->file('file');
            $nama_file =  $request->id . '.' . $file->getClientOriginalExtension();
            $tujuan_upload = 'pengumuman/';
            $lengkap = $tujuan_upload . $nama_file;
            $file->move($tujuan_upload, $nama_file);

            \App\pengumuman::where('id', $request->id)->update([
                'judul' => $request->judul,
                'isi' => $request->isi,
                'foto' => $lengkap
            ]);
            Session::flash('color', 'alert-success');
            Session::flash('pesan', 'Berhasil Edit Pengumuman');
            return redirect('/4dm1n/kelola-pengumuman');
        } else {
            \App\pengumuman::where('id', $request->id)->update([
                'judul' => $request->judul,
                'isi' => $request->isi
            ]);
            Session::flash('color', 'alert-danger');
            Session::flash('pesan', 'Berhasil Edit Pengumuman');
            return redirect('/4dm1n/kelola-pengumuman');
        }
    }

    public function kelas_matpel($id_ta, $id_kls)
    {
        return view('admin.kelolakelasmatpel', compact('id_ta', 'id_kls'));
    }

    public function kelas_matpel_tambah(Request $request)
    {
        $id = DB::table('pengajar_mata_pelajaran')->insertGetId([
            'id_pengajar' => $request->id_pengajar,
            'id_mata_pelajaran' => $request->id_matpel,
            'id_tahun_ajaran' => $request->id_ta
        ]);

        \App\pembelajaran::insert([
            'id_kelas' => $request->id_kls,
            'id_pengajar_mata_pelajaran' => $id
        ]);

        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil Tambah Mata Pelajaran Ke Kelas');
        return back();
    }

    public function kelas_matpel_hapus(Request $request)
    {
        \App\pengajar_mata_pelajaran::where('id', $request->id)->delete();

        Session::flash('color', 'alert-danger');
        Session::flash('pesan', 'Berhasil Hapus Mata Pelajaran Dari Kelas');
        return back();
    }

    public function kelas_santri($id_ta, $id_kls)
    {
        $ta = \App\tahun_ajaran::where('id', $id_ta)->first()->kelas_tahun_ajaran;
        $arr = array();
        foreach ($ta as $a) {
            if ($a->id_kelas != $id_kls) {
                $arr = array_merge($arr, (array) $a->id_kelas);
            }
        }
        $hsl = array();
        $snt = \App\santri::get();
        // return $arr;
        for ($i = 0; $i < count($snt); $i++) {
            $data = array();
            foreach (\App\data_per_kelas::where('id_santri', $snt[$i]->id)->pluck('id_kelas') as $a) {
                $data = array_merge($data, array($a));
            }

            // foreach ($arr as $v) {
            //     if (in_array($v, (array) \App\data_per_kelas::where('id_santri', $snt[$i]->id)->pluck('id_kelas'))) {
            //         unset($snt[$i]);
            //     }
            // }

            $x = array_intersect($arr, $data);
            if (empty($x)) {
            } else {
                unset($snt[$i]);
            }
        }
        return view('admin.kelola_kelas_santri', compact('snt', 'id_ta', 'id_kls'));
    }

    public function tambah_santri_ke_kelas(Request $request)
    {
        \App\data_per_kelas::insert([
            'id_santri' => $request->id_santri,
            'id_kelas' => $request->id_kls
        ]);
        return 1;
    }

    public function keluar_santri_santri_kelas(Request $request)
    {
        \App\data_per_kelas::where('id_santri', $request->id_santri)->where('id_kelas', $request->id_kls)->delete();

        return 1;
    }

    public function tambah_kelas_ta(Request $request)
    {
        $id = \App\kelas::insertGetId([
            'nama' => $request->nama
        ]);

        \App\kelas_tahun_ajaran::insert([
            'id_kelas' => $id,
            'id_tahun_ajaran' => $request->ta
        ]);

        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil Menambahkan Kelas');
        return back();
    }

    public function hapus_kelas_ta(Request $request)
    {
        \App\kelas::where('id', $request->id)->delete();

        Session::flash('color', 'alert-danger');
        Session::flash('pesan', 'Berhasil Hapus Kelas');
        return back();
    }

    public function kelola_artikel()
    {
        $artikel = artikel::get();
        return view('admin.kelola_artikel', compact('artikel'));
    }

    public function storeArtikel(Request $request)
    {
        $detail = $request->content;

        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        $summernote = new artikel;
        $summernote->save();

        //loop over img elements, decode their base64 src and save them to public folder,
        //and then replace base64 src with stored image URL.
        foreach ($images as $k => $img) {
            $data = $img->getattribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);

            $data = base64_decode($data);
            $image_name = time() . $k . '.png';
            $path = '/artikel/' . $image_name;
            gambarArtikel::insert([
                'nama' => $path,
                'id_artikel' => $summernote->id
            ]);
            file_put_contents(public_path() . $path, $data);

            $img->removeattribute('src');
            $img->setattribute('src', $path);
        }
        if ($request->file != null) {
            $i = 0;
            foreach ($request->file('file') as $r) {
                $filename = $r->getClientOriginalName();
                $extension = $r->getClientOriginalExtension();

                // File upload location
                $location = 'artikel';
                $nameUpload = time() . $i++ . '.' . $extension;
                // Upload file
                $r->move($location, $nameUpload);

                // Import CSV to Database
                $filepath = $location . "/" . $nameUpload;
                \App\file_artikel::insert([
                    'nama' => $filename,
                    'path' => $filepath,
                    'id_artikel' => $summernote->id
                ]);
            }
        }

        $detail = $dom->savehtml();
        $summernote->nama = $request->nama;
        $summernote->content = $detail;
        $summernote->save();

        // foreach($request->file as)

        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil Menambahkan Artikel');
        return redirect('/4dm1n/kelola-artikel');
    }

    public function bukaeditArtikel($id)
    {
        $artikel = artikel::find($id);
        return view('admin.tambah_edit_artikel', compact('artikel'));
    }

    public function editArtikel(Request $request)
    {
        $detail = $request->content;

        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');
        $summernote = artikel::find($request->id);

        //loop over img elements, decode their base64 src and save them to public folder,
        //and then replace base64 src with stored image URL.
        foreach ($images as $k => $img) {
            $data = $img->getattribute('src');

            if ($data[0] != '/') {
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);

                $data = base64_decode($data);
                $image_name = time() . $k . '.png';
                $path = 'artikel/' . $image_name;
                gambarArtikel::insert([
                    'nama' => $path,
                    'id_artikel' => $summernote->id
                ]);
                file_put_contents($path, $data);

                $img->removeattribute('src');
                $img->setattribute('src', '/' . $path);
            }
        }
        if ($request->file != null) {
            $i = 0;
            foreach ($request->file('file') as $r) {
                $filename = $r->getClientOriginalName();
                $extension = $r->getClientOriginalExtension();

                // File upload location
                $location = 'artikel';
                $nameUpload = time() . $i++ . '.' . $extension;
                // Upload file
                $r->move($location, $nameUpload);

                // Import CSV to Database
                $filepath = $location . "/" . $nameUpload;
                \App\file_artikel::insert([
                    'nama' => $filename,
                    'path' => $filepath,
                    'id_artikel' => $summernote->id
                ]);
            }
        }

        $detail = $dom->savehtml();
        $summernote->nama = $request->nama;
        $summernote->content = $detail;
        $summernote->save();

        Session::flash('color', 'alert-success');
        Session::flash('pesan', 'Berhasil Merubah Artikel');
        return redirect('/4dm1n/kelola-artikel');
    }

    public function hapusFileArtikel(Request $request)
    {
        File::delete(\App\file_artikel::where('id', $request->id)->get()[0]->path);
        \App\file_artikel::where('id', $request->id)->delete();

        return 1;
    }

    public function hapusArtikel(Request $request)
    {
        artikel::where('id', $request->id)->delete();

        $ga = gambarArtikel::where('id_artikel', $request->id)->pluck('nama');

        foreach ($ga as $g) {
            File::delete(substr($g, 1));
        }

        gambarArtikel::where('id_artikel', $request->id)->delete();

        Session::flash('color', 'alert-danger');
        Session::flash('pesan', 'Berhasil Menghapus Artikel');
        return redirect('/4dm1n/kelola-artikel');
    }
}
