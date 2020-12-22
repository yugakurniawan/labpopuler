<?php

namespace App\Http\Controllers;

use App\HasilKuisioner;
use App\Kuisioner;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function cek_kuisioner()
    {
        if (auth()->user()->peran->nama == 'Dokter') {
            $hasil_kuisioner = HasilKuisioner::where('user_id',auth()->user()->id)->get();
            $count = 0;
            $kuisioner = Kuisioner::count();

            foreach ($hasil_kuisioner as $item) {
                if (date('Y-m', strtotime($item->tanggal_mengisi_kuisioner)) == date('Y-m')) {
                    $count++;
                }
            }

            if ($count != $kuisioner) {
                return true;
            }
            return false;
        }
    }
}
