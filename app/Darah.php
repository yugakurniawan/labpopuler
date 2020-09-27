<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Darah extends Model
{
    protected $table = 'tb_goldar';
    public $timestamps = false;
    protected $primaryKey = 'kode';
    protected $guarded = [];
}
