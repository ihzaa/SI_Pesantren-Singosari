<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Empty_;

class front_end extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengumuman = \App\pengumuman::paginate(4);
        return view('front-end.index', compact('pengumuman'));
    }

    function load_data(Request $request)
    {
        if ($request->ajax()) {
            if ($request->id > 0) {
                $data = DB::table('pengumuman')
                    ->where('id', '<=', $request->id)
                    ->orderBy('id', 'DESC')
                    ->limit(4)
                    ->get();
            } else if ($request->id == 0) {
                $data = DB::table('pengumuman')
                    ->where('id', 'abc')
                    ->get();
            } else {
                $data = DB::table('pengumuman')
                    ->orderBy('id', 'DESC')
                    ->where('prioritas', 'n')
                    ->limit(4)
                    ->get();
            }
            $output = '';
            $last_id = '';

            if (!$data->isEmpty()) {
                $output .= '<div class="row justify-content-center" style="background-color: #4281A7;">';
                foreach ($data as $row) {
                    $output .= '
                    <div class="col-xl-3 col-md-3 col-sm-12 col-xs-12  mt-4 ">
                    <a href="/informasi/' . $row->id . '/.' . $row->judul . '">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">

                                    <h6 class="m-0 font-weight-bold text-primary">' . $row->judul . '</h6>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col ">
                                        <a href="/informasi/' . $row->id . '/.' . $row->judul . '">
                                            <img src="' . $row->foto . '" alt="image" class="img-fluid">
                                        </a>
                                    </div>
                                </div>
                                <p class="text-lg mb-0 text-dark">' . str_limit($row->isi, 60) . '</p>
                            </div>
                        </div>
                        </a>
                    </div>
                    ';
                    $last_id = $row->id - 1;
                }
                $output .= '</div>';
                $output .= '
                    <div id="load_more">
                        <button type="button" name="load_more_button" class="btn btn-outline-light" data-id="' . $last_id . '" id="load_more_button">Lihat Lainnya</button>
                    </div>
                    ';
            } else {
                $output .= '
                    <div id="load_more">
                        <button type="button" name="load_more_button" class="btn btn-warning">Semua Informasi Sudah di Tampilkan</button>
                    </div>
                    ';
            }
            echo $output;
        }
    }

    public function liat_artikel($id)
    {
        $artikel = \App\artikel::find($id);
        return view('front-end.Information.artikel', compact('artikel'));
    }

    function load_data_artikel(Request $request)
    {
        if ($request->ajax()) {
            if ($request->id > 0) {
                $data = DB::table('artikels')
                    ->where('id', '>', $request->id)
                    ->orderBy('id', 'ASC')
                    ->limit(4)
                    ->get();
            } else if ($request->id == 0) {
                $data = DB::table('artikels')
                    ->where('id', 'asd')
                    ->get();
            }
            $output = '';
            $last_id = '';

            if (!$data->isEmpty()) {
                $output .= '<div class="row justify-content-center" style="background-color: #4281A7;">';
                foreach ($data as $row) {
                    $output .= '
                    <div class="col-xl-3 col-md-3 col-sm-12 col-xs-12 mt-4 hideme box">
                    <a href="/lihat/artikel/'.$row->id.'">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">

                                    <h6 class="m-0 font-weight-bold text-primary">'.$row->nama.'</h6>

                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col ">
                                        '.'<p class="mb-0 text-dark">'.strip_tags(html_entity_decode(str_limit($row->content,80))).'</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                    ';
                    $last_id = $row->id;
                }
                $output .= '</div>';
                $output .= '
                    <div id="load_more">
                        <button type="button" name="load_more_button" class="btn btn-outline-light" data-id="' . $last_id . '" id="load_more_button_artikel">Lihat Lainnya</button>
                    </div>
                    ';
            } else {
                $output .= '
                    <div id="load_more">
                        <button type="button" name="load_more_button" class="btn btn-warning">Semua Artikel Sudah di Tampilkan</button>
                    </div>
                    ';
            }
            echo $output;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pengumuman($id, $nama)
    {
        $pengumuman = \App\pengumuman::where('id', $id)->first();
        $other = \App\pengumuman::where('id', '!=', $id)->orderBy('id', 'DESC')->get()->take(10);
        return view('front-end.Information.pengumuman', compact('pengumuman', 'other'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
