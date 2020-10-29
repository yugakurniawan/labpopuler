<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PilihJawabanKuisioner extends Model
{
    protected $table = "pilih_jawaban_kuisioner";
    protected $guarded = [];

    public function kuisioner()
    {
        return $this->belongsTo('App\Kuisioner');
    }
}
