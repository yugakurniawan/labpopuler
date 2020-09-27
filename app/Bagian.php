<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    protected $table = 'tb_bagian';
    public $timestamps = false;
    protected $primaryKey = 'kode';
    protected $guarded = [];
}
