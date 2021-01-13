<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasTest extends Model
{
    protected $table = 'tb_pastest2';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $primaryKey = 'nolab';
    protected $guarded = [];

    public function test()
    {
        return $this->belongsTo('App\Test','kodetest');
    }

    public function test1()
    {
        return $this->belongsTo('App\Test','kodesub');
    }

    public function pasien_dokter()
    {
        return $this->belongsTo('App\PasienDokter','nolab');
    }
}
