<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasilKuisioner extends Model
{
    protected $table = "hasil_kuisioner";
    protected $guarded = [];

    public function jenis_pertanyaan()
    {
        return $this->belongsTo('App\JenisPertanyaan');
    }

    public function opsi_jawaban()
    {
        return $this->hasMany('App\OpsiJawaban');
    }
}
