<?php

namespace App\Http\Controllers;

use App\Dokter;
use App\JenisPertanyaan;
use App\Kuisioner;
use App\PilihJawabanKuisioner;
use App\User;
use Illuminate\Http\Request;

class KuisionerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->bulan) {
            return redirect('kuisioner?bulan='.date('Y-m'));
        }

        $dokter = Dokter::paginate(15);
        if ($request->cari) {
            $dokter = Dokter::where('nama','like',"%$request->cari%")
                            ->orWhere('hp','like',"%$request->cari%")
                            ->orWhere('telp','like',"%$request->cari%")
                            ->orWhere('alamat','like',"%$request->cari%")
                            ->paginate(15);
        }

        $dokter->appends($request->all());
        return view('kuisioner.index', compact('dokter'));
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
        $request->validate([
            'pertanyaan.*' => ['required']
        ]);

        foreach (Kuisioner::all() as $kuisioner) {
            $kuisioner->delete();
        }

        $opsi = 0;

        foreach ($request->pertanyaan as $key => $item) {
            $kuisioner = Kuisioner::create([
                'jenis_pertanyaan_id'   => $request->jenis_pertanyaan_id[$key],
                'pertanyaan'            => $item
            ]);

            foreach ($request->opsi as $no => $value) {
                if ($no >= $opsi && $no < $request->banyak_opsi[$key] + $opsi) {
                    PilihJawabanKuisioner::create([
                        'kuisioner_id'  => $kuisioner->id,
                        'opsi'          => $value
                    ]);
                }
            }

            $opsi += $request->banyak_opsi[$key];
        }

        return redirect()->back()->with('success', 'Pengaturan Kuisioner berhasil diperbarui');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kuisioner  $kuisioner
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, $bulan)
    {
        $kuisioner = Kuisioner::all();
        return view('kuisioner.show', compact('user','bulan','kuisioner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kuisioner  $kuisioner
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $kuisioner = Kuisioner::all();
        $jenis_pertanyaan = JenisPertanyaan::all();
        return view('kuisioner.edit', compact('kuisioner','jenis_pertanyaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kuisioner  $kuisioner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kuisioner $kuisioner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kuisioner  $kuisioner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kuisioner $kuisioner)
    {
        //
    }
}
