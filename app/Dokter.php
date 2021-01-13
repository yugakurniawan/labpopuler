<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'tb_dokter';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $primaryKey = 'kode';
    protected $guarded = [];

    public function jadwalKunjungan()
    {
        return $this->hasMany('App\JadwalKunjungan','dokter_id');
    }
}
