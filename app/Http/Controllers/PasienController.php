<?php

namespace App\Http\Controllers;

use App\Agama;
use App\Bagian;
use App\Darah;
use App\Http\Requests\PasienRequest;
use App\Kota;
use App\Negara;
use App\Pasien;
use App\PasienDokter;
use App\Pekerjaan;
use App\Pendidikan;
use App\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
            })->orderBy('noreg','desc')->paginate(15);
        }

        $pasien->appends(request()->input())->links();

        return view('pasien.index', compact('pasien'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dokter(Request $request)
    {
        $pasien = PasienDokter::where('kodedokter',auth()->user()->dokter->kode)->orderBy('noreg','desc')->paginate(15);

        $pasien->appends(request()->input())->links();

        return view('pasien.dokter', compact('pasien'));
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
            'negara'    => Negara::all(),
            'kota'      => Kota::all(),
            'pekerjaan' => Pekerjaan::all(),
            'pendidikan'=> Pendidikan::all(),
            'title'     => Title::all(),
            'darah'     => Darah::all(),
            'bagian'    => Bagian::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PasienRequest $request)
    {
        $data = $request->validated();

        if ($request->fhoto) {
            $data['fhoto']  = $request->fhoto->store('pasien');
        }

        $data['tgl_tran'] = date('Y-m-d');
        $data['userupdate'] = now();

        Pasien::create($data);
        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function show(Pasien $pasien)
    {
        return view('pasien.show', [
            'agama'     => Agama::all(),
            'negara'    => Negara::all(),
            'kota'      => Kota::all(),
            'pekerjaan' => Pekerjaan::all(),
            'pendidikan'=> Pendidikan::all(),
            'title'     => Title::all(),
            'darah'     => Darah::all(),
            'bagian'    => Bagian::all(),
            'pasien'    => $pasien,
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
        return view('pasien.edit', [
            'agama'     => Agama::all(),
            'negara'    => Negara::all(),
            'kota'      => Kota::all(),
            'pekerjaan' => Pekerjaan::all(),
            'pendidikan'=> Pendidikan::all(),
            'title'     => Title::all(),
            'darah'     => Darah::all(),
            'bagian'    => Bagian::all(),
            'pasien'    => $pasien,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function update(PasienRequest $request, Pasien $pasien)
    {
        $data = $request->validated();

        if ($request->fhoto) {
            if ($pasien->fhoto) {
                File::delete(storage_path('app/'. $pasien->fhoto));
            }
            $data['fhoto']  = $request->fhoto->store('pasien');
        }

        $data['userupdate'] = now();

        $pasien->update($data);
        return redirect()->route('pasien.edit', $pasien)->with('success', 'Pasien berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pasien $pasien)
    {
        if ($pasien->fhoto) {
            File::delete(storage_path('app/'. $pasien->fhoto));
        }
        $pasien->delete();
        return redirect()->back()->with('success', 'Pasien berhasil dihapus');
    }
}
