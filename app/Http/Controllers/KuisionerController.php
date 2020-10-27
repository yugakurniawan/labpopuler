<?php

namespace App\Http\Controllers;

use App\JenisPertanyaan;
use App\Kuisioner;
use Illuminate\Http\Request;

class KuisionerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'pertanyaan' => ['required']
        ]);

        Kuisioner::truncate();

        foreach ($request->pertanyaan as $key => $item) {
            Kuisioner::create([
                'jenis_pertanyaan_id'   => $request->jenis_pertanyaan_id[$key],
                'pertanyaan'            => $item
            ]);
        }

        return redirect()->back()->with('success', 'Pengaturan Kuisioner berhasil diperbarui');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kuisioner  $kuisioner
     * @return \Illuminate\Http\Response
     */
    public function show(Kuisioner $kuisioner)
    {
        //
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
