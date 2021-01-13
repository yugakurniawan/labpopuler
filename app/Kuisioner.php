<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kuisioner extends Model
{
    protected $table = "kuisioner";
    protected $guarded = [];

    public function jenis_pertanyaan()
    {
        return $this->belongsTo('App\JenisPertanyaan');
    }

    public function pilih_jawaban_kuisioner()
    {
        return $this->hasMany('App\PilihJawabanKuisioner');
    }
}
