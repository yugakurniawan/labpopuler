<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpsiJawaban extends Model
{
    protected $table = "opsi_jawaban";
    protected $guarded = [];

    public function hasil_kuisioner()
    {
        return $this->belongsTo('App\HasilKuisioner');
    }
}
