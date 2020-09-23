<?php

namespace App\Http\Controllers;

use App\Agama;
use App\Kota;
use App\Pasien;
use App\Pekerjaan;
use App\Pendidikan;
use App\Title;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pasien = Pasien::orderBy('noreg','desc')->paginate(15);

        if ($request->cari) {
            $pasien = Pasien::where(function ($user) use ($request) {
                $user->Where('noreg','like',"%$request->cari%");
                $user->orWhere('nama','like',"%$request->cari%");
                $user->orWhere('kelamin','like',"%$request->cari%");
                $user->orWhere('tmp_lahir','like',"%$request->cari%");
                $user->orWhere('alamat','like',"%$request->cari%");
            })->latest()->paginate(15);
        }

        $pasien->appends(request()->input())->links();

        return view('pasien.index', compact('pasien'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pasien.create', [
            'agama'     => Agama::all(),
            'kota'      => Kota::all(),
            'pekerjaan' => Pekerjaan::all(),
            'pendidikan'=> Pendidikan::all(),
            'title'     => Title::all()
        ]);
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
     * @param  \App\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function show(Pasien $pasien)
    {
        return view('user.create', [
            'agama'     => Agama::all(),
            'Kota'      => Kota::all(),
            'Pekerjaan' => Pekerjaan::all(),
            'Pendidikan'=> Pendidikan::all(),
            'Title'     => Title::all(),
            'pasien'     => $pasien
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function edit(Pasien $pasien)
    {
        return view('user.create', [
            'agama'     => Agama::all(),
            'Kota'      => Kota::all(),
            'Pekerjaan' => Pekerjaan::all(),
            'Pendidikan'=> Pendidikan::all(),
            'Title'     => Title::all(),
            'pasien'     => $pasien
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pasien $pasien)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pasien $pasien)
    {
        //
    }
}
