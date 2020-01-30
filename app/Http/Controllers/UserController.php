<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cek(Request $request)
    {
        $usr = \App\User::where('username', $request->username)->first();
        if ($usr) {
            if (Hash::check($request->password, $usr->password)) {
                if ($usr->role == 2) {
                    Session::put('pengajarlogin', $usr->pengajar);
                    return view('Pengajar.halamanutamapengajar');
                } else if ($usr->role == 3) {
                    Session::put('santrilogin', $usr->santri);
                    return $usr->santri;
                }
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if(!Session::get('pengajarlogin') && !Session::get('santrilogin')){
            return redirect('/login');
        }
        if(Session::get('santrilogin')){
            return Session::get('santrilogin');
        }
        if(Session::get('pengajarlogin')){
            return redirect('/pengajar');
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
    public function show($id)
    {
        //
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
