<?php

namespace App\Http\Middleware;

use App\HasilKuisioner;
use App\Kuisioner as AppKuisioner;
use Closure;

class Kuisioner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $hasil_kuisioner = HasilKuisioner::where('user_id',$request->user()->id)->get();
        $count = 0;
        $kuisioner = AppKuisioner::count();
        foreach ($hasil_kuisioner as $item) {
            if (date('Y-m', strtotime($item->tanggal_mengisi_kuisioner)) == date('Y-m')) {
                $count++;
            }
        }

        if ($count == $kuisioner) {
            return $next($request);
        }

        return redirect()->route('kuisioner.create');
    }
}
