<?php

namespace App\Http\Controllers;

use App\Dokter;
use App\JadwalKunjungan;
use Illuminate\Http\Request;

class JadwalKunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch (auth()->user()->peran->nama) {
            case 'Dokter':
                if ($this->cek_kuisioner()) {
                    return redirect()->route('kuisioner.create');
                }

                $jadwal_kunjungan = JadwalKunjungan::where('dokter_id', auth()->user()->dokter->kode)->latest()->paginate(10);
                break;

            case 'Marketing':
                $jadwal_kunjungan = JadwalKunjungan::where('user_id', auth()->user()->id)->latest()->paginate(10);
                break;

            default:
                $jadwal_kunjungan = JadwalKunjungan::latest()->paginate(10);
                break;
        }
        return view('jadwal-kunjungan.index',compact('jadwal_kunjungan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jadwal-kunjungan.create',['dokter' => Dokter::all()]);
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
            'dokter_id' => ['required'],
            'jadwal'    => ['required','date','after:now']
        ],[
            'dokter_id.required'    => 'dokter wajib diisi'
        ]);

        JadwalKunjungan::create([
            'user_id'   => auth()->user()->id,
            'dokter_id' => $request->dokter_id,
            'jadwal'    => $request->jadwal
        ]);

        return redirect()->route('jadwal-kunjungan.index')->with('success', 'Jadwal Kunjungan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JadwalKunjungan  $jadwal_kunjungan
     * @return \Illuminate\Http\Response
     */
    public function show(JadwalKunjungan $jadwal_kunjungan)
    {
        if ($this->cek_kuisioner()) {
            return redirect()->route('kuisioner.create');
        }
        if ($jadwal_kunjungan->status == 1) {
            if (auth()->user()->peran->nama == "Marketing") {
                $jadwal_kunjungan->update(['dilihat_marketing' => 1]);
            }
            if (auth()->user()->peran->nama == "Manager Marketing") {
                $jadwal_kunjungan->update(['dilihat_manager_marketing' => 1]);
            }
        }
        return view('jadwal-kunjungan.show',compact('jadwal_kunjungan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JadwalKunjungan  $jadwal_kunjungan
     * @return \Illuminate\Http\Response
     */
    public function edit(JadwalKunjungan $jadwal_kunjungan)
    {
        if ($jadwal_kunjungan->status == 1) {
            return redirect()->route('jadwal-kunjungan.show', $jadwal_kunjungan);
        }
        $dokter = Dokter::all();
        return view('jadwal-kunjungan.edit',compact('jadwal_kunjungan','dokter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JadwalKunjungan  $jadwal_kunjungan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JadwalKunjungan $jadwal_kunjungan)
    {
        if ($this->cek_kuisioner()) {
            return redirect()->route('kuisioner.create');
        }

        $data = $request->validate([
            'dokter_id' => ['required'],
            'jadwal'    => ['required','date'],
            'status'    => ['nullable']
        ],[
            'dokter_id.required'    => 'dokter wajib diisi',
        ]);

        if (auth()->user()->peran->nama == 'Dokter') {
            if ($request->status == 1 || $request->status == 2) {
                $data['dilihat_dokter'] = 1;
                $data['dilihat_marketing'] = 0;
                $data['dilihat_manager_marketing'] = 0;
            }
        } elseif (auth()->user()->peran->nama == 'Marketing'){
            $data['dilihat_dokter'] = 0;
            $data['dilihat_manager_marketing'] = 0;
            $data['status'] = 0;
        }

        if (strtotime($jadwal_kunjungan->jadwal) > strtotime(now())) {
            $jadwal_kunjungan->update($data);
        }

        return redirect()->route('jadwal-kunjungan.show',$jadwal_kunjungan)->with('success', 'Jadwal Kunjungan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JadwalKunjungan  $jadwal_kunjungan
     * @return \Illuminate\Http\Response
     */
    public function destroy(JadwalKunjungan $jadwal_kunjungan)
    {
        if ($this->cek_kuisioner()) {
            return redirect()->route('kuisioner.create');
        }

        if ($jadwal_kunjungan->status != 1) {
            $jadwal_kunjungan->delete();
        }

        return redirect()->route('jadwal-kunjungan.index')->with('success', 'Jadwal Kunjungan berhasil dihapus');
    }
}
