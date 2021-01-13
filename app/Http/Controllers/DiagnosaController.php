<?php

namespace App\Http\Controllers;

use App\PasienDokter;
use App\Diagnosa;
use App\PasTest;
use Illuminate\Http\Request;

class DiagnosaController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $diagnosa = Diagnosa::find($id);
        $pastest = PasTest::where('nolab',$id)->get()->groupBy('kodetest');
        if ($diagnosa == null) {
            $diagnosa = (object)[
                'nolab' => $id,
                'diagnosa' => null,
                'pasienDokter' => PasienDokter::where('nolab',$id)->first(),
                'tambah' => true
            ];
        }

        return view('diagnosa.show', compact('diagnosa','pastest'));
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
        $data = $request->validate([
            'nolab'         => ['required','numeric'],
            'diagnosa'      => ['required'],
        ]);

        if ($request->tambah == 1) {
            Diagnosa::create($data);
        } else {
            Diagnosa::find($id)->update(['diagnosa' => $request->diagnosa]);
        }

        return redirect()->back()->with('success', 'Diagnosa berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diagnosa $diagnosa)
    {
        $diagnosa->delete();
        PasienDokter::where('nolab', $diagnosa->nolab)->delete();
        return redirect()->back()->with('success', 'Diagnosa berhasil dihapus');
    }
}
