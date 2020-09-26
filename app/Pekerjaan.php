<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pekerjaan extends Model
{
    protected $table = 'tb_pekerjaan';
    public $timestamps = false;
    protected $primaryKey = 'kode';
    protected $guarded = [];
}
