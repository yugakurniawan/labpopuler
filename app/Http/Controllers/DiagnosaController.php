<?php

namespace App\Http\Controllers;

use App\Pasien;
use App\PasienDokter;
use App\PasienSaran;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pasien $pasien)
    {
        return view('diagnosa.create', compact('pasien'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nolab'         => ['required','numeric','unique:tb_passaran,nolab'],
            'saran'         => ['required'],
            'kesimpulan'    => ['required']
        ],[
            'nolab.required' => 'Nomor Lab wajib diisi',
            'nolab.numeric' => 'Nomor Lab harus berupa angka',
        ]);

        $data['tgl_tran'] = date('Y-m-d');
        $pasien = Pasien::find($request->noreg);
        PasienSaran::create($data);
        PasienDokter::create([
            'noreg'     => $request->noreg,
            'tgl_tran'  => date('Y-m-d'),
            'kodedokter'=> auth()->user()->dokter->kode,
            'nolab'     => $request->nolab,
            'nama'      => $pasien->nama
        ]);
        return redirect()->route('pasien.show',$request->noreg)->with('success', 'Diagnosa berhasil ditambahkan');
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
        $diagnosa = PasienSaran::find($id);
        if ($diagnosa == null) {
            $diagnosa = (object)[
                'nolab' => $id,
                'saran' => null,
                'kesimpulan' => null,
                'pasienDokter' => (object) [
                    'noreg' => PasienDokter::where('nolab',$id)->first()->noreg
                ],
                'tambah' => true
            ];
        }
        return view('diagnosa.edit', compact('diagnosa'));
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
        if ($request->tambah == 1) {
            $data = $request->validate([
                'nolab'         => ['required','numeric'],
                'saran'         => ['required'],
                'kesimpulan'    => ['required']
            ]);
            $data['tgl_tran'] = date('Y-m-d');
            PasienSaran::create($data);
        } else {
            PasienSaran::find($id)->update($request->all());
        }
        return redirect()->back()->with('success', 'Diagnosa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PasienSaran $diagnosa)
    {
        $diagnosa->delete();
        PasienDokter::where('nolab', $diagnosa->nolab)->delete();
        return redirect()->back()->with('success', 'Diagnosa berhasil dihapus');
    }
}
