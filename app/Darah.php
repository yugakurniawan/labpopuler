<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Darah extends Model
{
    protected $table = 'tb_goldar';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $primaryKey = 'kode';
    protected $guarded = [];
}
