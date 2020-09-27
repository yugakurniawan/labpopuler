<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'tb_pasien';
    public $timestamps = false;
    protected $primaryKey = 'noreg';
    protected $guarded = [];

    public function title()
    {
        return $this->belongsTo('App\Title', 'title_id');
    }

    public function agama()
    {
        return $this->belongsTo('App\Agama', 'agama');
    }

    public function darah()
    {
        return $this->belongsTo('App\Darah', 'darah');
    }

    public function negara()
    {
        return $this->belongsTo('App\Negara', 'negara');
    }

    public function kota()
    {
        return $this->belongsTo('App\Kota', 'kota');
    }

    public function pekerjaan()
    {
        return $this->belongsTo('App\Pekerjaan', 'pekerjaan');
    }

    public function pendidikan()
    {
        return $this->belongsTo('App\Pendidikan', 'pendidikan');
    }
}
