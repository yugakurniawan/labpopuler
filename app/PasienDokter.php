<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasienDokter extends Model
{
    protected $table = 'v_pasien_dokter';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $primaryKey = 'noreg';
    protected $guarded = [];

    public function pasien()
    {
        return $this->belongsTo('App\Pasien', 'noreg');
    }

    public function dokter()
    {
        return $this->belongsTo('App\Dokter', 'kodedokter');
    }

    public function pasienSaran()
    {
        return $this->belongsTo('App\PasienSaran', 'nolab');
    }
}
