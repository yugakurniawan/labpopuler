<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    protected $table = 'tb_agama';
    public $timestamps = false;
    protected $primaryKey = 'kode';
    protected $guarded = [];
}
