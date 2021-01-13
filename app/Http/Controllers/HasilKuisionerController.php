<?php

namespace App\Http\Controllers;

use App\HasilKuisioner;
use Illuminate\Http\Request;

class HasilKuisionerController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            '*' => ['required']
        ]);

        $data = [
            'user_id'               => $request->user_id,
            'pertanyaan'            => $request->pertanyaan,
            'jenis_pertanyaan_id'   => $request->jenis_pertanyaan_id,
            'jawaban'               => []
        ];

        $jawaban = $request->all();

        $array = [];
        foreach ($request->all() as $key => $value) {
            preg_match('/.*checkbox/',$key,$checkbox);
            array_push($array, $checkbox);
        }

        foreach($array as $item) {
            if ($item != []) {
                unset($jawaban[$item[0]]);
            }
        }

        unset($jawaban['_token']);
        unset($jawaban['user_id']);
        unset($jawaban['pertanyaan']);
        unset($jawaban['jenis_pertanyaan_id']);

        foreach ($jawaban as $key => $value) {
            array_push($data['jawaban'], $value);
        }

        foreach ($data['pertanyaan'] as $key => $item) {
            if (is_array($data['jawaban'][$key])) {
                $jawaban = '';
                foreach ($data['jawaban'][$key] as $value) {
                    $jawaban .= '['. $value .']';
                }
                $data['jawaban'][$key] = $jawaban;
            }
            HasilKuisioner::create([
                'user_id'                   => $data['user_id'],
                'pertanyaan'                => $data['pertanyaan'][$key],
                'jenis_pertanyaan_id'       => $data['jenis_pertanyaan_id'][$key],
                'jawaban'                   => $data['jawaban'][$key],
                'tanggal_mengisi_kuisioner' => date('Y-m-d')
            ]);
        }

        return redirect()->route('home')->with('success', 'Terima kasih telah mengisi kuisioner bulan ini');
    }
}
