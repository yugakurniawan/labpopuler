<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    protected $table = 'tb_kota';
    public $timestamps = false;
    protected $primaryKey = 'kode';
    protected $guarded = [];
}
