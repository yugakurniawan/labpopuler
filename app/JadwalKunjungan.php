<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalKunjungan extends Model
{
    protected $table = "jadwal_kunjungan";
    protected $guarded = [];

    public function dokter()
    {
        return $this->belongsTo('App\Dokter','dokter_id');
    }
}
