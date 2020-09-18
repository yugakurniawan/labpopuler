<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'tb_dokter';
    public $timestamps = false;
    protected $primaryKey = 'kode';
}
