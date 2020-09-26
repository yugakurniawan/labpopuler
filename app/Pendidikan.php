<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    protected $table = 'tb_pendidikan';
    public $timestamps = false;
    protected $primaryKey = 'kode';
    protected $guarded = [];
}
