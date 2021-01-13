<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    protected $table = 'diagnosa';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $primaryKey = 'nolab';
    protected $guarded = [];

    public function pasienDokter()
    {
        return $this->hasOne('App\PasienDokter','nolab');
    }
}
