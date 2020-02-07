<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
                    ->where('id', '<', $request->id)
                    ->where('prioritas','n')
                    ->orderBy('id', 'DESC')
                    ->limit(4)
                    ->get();
            } else {
                $data = DB::table('pengumuman')
                    ->orderBy('id', 'DESC')
                    ->where('prioritas','n')
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
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <a href="/pengumuman/'.$row->id.'/.'.$row->judul.'">
                                    <h6 class="m-0 font-weight-bold text-primary">'.$row->judul.'</h6>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col ">
                                        <a href="/pengumuman/'.$row->id.'/.'.$row->judul.'">
                                            <img src="'.$row->foto.'" alt="image" class="img-fluid">
                                        </a>
                                    </div>

                                </div>
                                <?php
                                    echo "<p class="text-lg mb-0">"'.str_limit($row->isi,60).'</p>";
                                ?>
                            </div>
                        </div>
                    </div>
                    ';
                    $last_id = $row->id;
                }
                $output .= '</div>';
                $output .= '
                    <div id="load_more">
                        <button type="button" name="load_more_button" class="btn btn-success form-control" data-id="' . $last_id . '" id="load_more_button">Load More</button>
                    </div>
                    ';
                } else {
                $output .= '
                    <div id="load_more">
                        <button type="button" name="load_more_button" class="btn btn-info form-control">No Data Found</button>
                    </div>
                    ';
                }
            echo $output;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        return view('front-end.Information.pengumuman', compact('pengumuman'));
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
