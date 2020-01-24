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

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
    }

    public function cek(Request $request)
    {
        $user = \App\user::where('username', $request->username)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                if ($user->role == 1) {
                    Session::put('adminlogin', $user->admin);
                    return redirect('/4dm1n/');
                } else if ($user->role == 2) {
                    return $user->pengajar;
                } else {
                    return $user->santri;
                }
            }
        }
        Session::flash('pesan', 'Username atau Password Salah');
        return redirect('/login');
    }

    public function adminidx()
    {
        $sesi_admin = Session::get('adminlogin');
        if ($sesi_admin)
            return view('admin.index');
        else
            return redirect('/login');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }

    public function adminkelolasantri()
    {
        $sesi_admin = Session::get('adminlogin');
        $santri = \App\santri::get();
        if ($sesi_admin)
            return view('admin.kelolasantri', compact('santri'));
        else
            return redirect('/login');
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
        $sesi_admin = Session::get('adminlogin');
        if ($sesi_admin) {
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
        } else
            return redirect('/login');
    }

    public function tambahsantri(Request $request)
    {
        $validatedData = Validator::make(request()->all(), [
            'nama' => 'required|max:255',
            'nis' => 'require',
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
        $sesi_admin = Session::get('adminlogin');
        if ($sesi_admin) {
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
        } else
            return redirect('/login');
    }

    public function hapussantri(Request $request)
    {
        $sesi_admin = Session::get('adminlogin');
        if ($sesi_admin) {
            \App\user::where('id', $request->id)->delete();
            Session::flash('color', 'alert-success');
            Session::flash('pesan', 'Berhasil Menghapus Data');
            return redirect('/4dm1n/kelola-santri');
        } else {
            return redirect('/login');
        }
    }

    public function tambahfilesantri(Request $request)
    {
        $sesi_admin = Session::get('adminlogin');
        if ($sesi_admin) {
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
            $maxFileSize = 10097152;

            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {

                // Check file size
                if ($fileSize <= $maxFileSize) {

                    // File upload location
                    $location = 'uploads';

                    // Upload file
                    $file->move($location, $filename);

                    // Import CSV to Database
                    $filepath = public_path($location . "/" . $filename);

                    // Reading file
                    $file = fopen($filepath, "r");

                    $importData_arr = array();
                    $i = 0;
                    $theRightColumn = [
                        'no', 'nis', 'nama', 'jenis kelamin - l atau p', 'tempat lahir', 'tanggal lahir - hh/mm/tttt',
                        'telp', 'alamat', 'tahun masuk', 'nama wali', 'telp wali', 'JANGAN MENGUBAH DAN MENGHAPUS NAMA KOLOM'
                    ];
                    while (($filedata = fgetcsv($file, 1000, ";")) !== FALSE) {
                        $num = count($filedata);

                        // Skip first row (Remove below comment if you want to skip the first row)
                        if ($i == 0) {
                            for ($c = 0; $c < $num; $c++) {
                                $importData_arr[$i][] = $filedata[$c];
                            }
                            if (array_diff($theRightColumn, $importData_arr[$i])) {
                                Session::flash('color', 'alert-danger');
                                Session::flash('pesan', 'Kolom tidak sesuai dengan contoh file');
                                return redirect('/4dm1n/kelola-santri');
                            }
                            continue;
                        }
                        for ($c = 0; $c < $num; $c++) {
                            if ($c == 5) {
                                $temp = explode("/", $filedata[5]);
                                $importData_arr[$i][] = "$temp[2]-$temp[1]-$temp[0]";
                                continue;
                            }
                            $importData_arr[$i][] = $filedata[$c];
                        }
                        $i++;
                    }
                    fclose($file);
                    File::delete(public_path($location . "/" . $filename));
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
                            'telp_wali' => $importData[10],
                            'telp' => $importData[6],
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
        return redirect('/login');
    }

    public function downloadexcsvsantri()
    {
        return Response::download(public_path() . '/Downloadable/Contoh File CSV Santri.csv', 'Contoh File CSV Santri.csv');
    }


    public function adminkelolapengajar()
    {
        $sesi_admin = Session::get('adminlogin');
        $pengajar = \App\pengajar::get();
        if ($sesi_admin)
            return view('admin.kelolapengajar', compact('pengajar'));
        else
            return redirect('/login');
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

        $sesi_admin = Session::get('adminlogin');
        if ($sesi_admin) {
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
        } else
            return redirect('/login');
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
        $sesi_admin = Session::get('adminlogin');
        if ($sesi_admin) {
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
        } else
            return redirect('/login');
    }

    public function tambahfilepengajar(Request $request)
    {
        $sesi_admin = Session::get('adminlogin');
        if ($sesi_admin) {
            if ($request->file != null) {

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
                $maxFileSize = 10097152;

                // Check file extension
                if (in_array(strtolower($extension), $valid_extension)) {

                    // Check file size
                    if ($fileSize <= $maxFileSize) {

                        // File upload location
                        $location = 'uploads';

                        // Upload file
                        $file->move($location, $filename);

                        // Import CSV to Database
                        $filepath = public_path($location . "/" . $filename);

                        // Reading file
                        $file = fopen($filepath, "r");

                        $importData_arr = array();
                        $i = 0;
                        $theRightColumn = [
                            'no', 'nip', 'nama', 'telepon', 'tempat lahir',
                            'tanggal lahir - hh/mm/tttt', 'jenis kelamin - l atau p', 'email',
                            'JANGAN MENGUBAH DAN MENGHAPUS NAMA KOLOM'
                        ];
                        while (($filedata = fgetcsv($file, 1000, ";")) !== FALSE) {
                            $num = count($filedata);

                            // Skip first row (Remove below comment if you want to skip the first row)
                            if ($i == 0) {
                                for ($c = 0; $c < $num; $c++) {
                                    $importData_arr[$i][] = $filedata[$c];
                                }
                                if (array_diff($theRightColumn, $importData_arr[$i])) {
                                    Session::flash('color', 'alert-danger');
                                    Session::flash('pesan', 'Kolom tidak sesuai dengan contoh file');
                                    return redirect('/4dm1n/kelola-pengajar');
                                }
                                continue;
                            }
                            for ($c = 0; $c < $num; $c++) {
                                if ($c == 5) {
                                    $temp = explode("/", $filedata[5]);
                                    $importData_arr[$i][] = "$temp[2]-$temp[1]-$temp[0]";
                                    continue;
                                }
                                $importData_arr[$i][] = $filedata[$c];
                            }
                            $i++;
                        }
                        fclose($file);
                        File::delete(public_path($location . "/" . $filename));
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
                                'telp' => $importData[3],
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
        return redirect('/login');
    }

    public function hapuspengajar(Request $request)
    {
        $sesi_admin = Session::get('adminlogin');
        if ($sesi_admin) {
            \App\user::where('id', $request->id)->delete();
            Session::flash('color', 'alert-success');
            Session::flash('pesan', 'Berhasil Menghapus Data');
            return redirect('/4dm1n/kelola-pengajar');
        } else {
            return redirect('/login');
        }
    }

    public function downloadexcsvpengajar()
    {
        return Response::download(public_path() . '/Downloadable/Contoh File CSV pengajar.csv', 'Contoh File CSV pengajar.csv');
    }
}
