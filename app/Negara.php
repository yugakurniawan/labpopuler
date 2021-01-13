<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Negara extends Model
{
    protected $table = 'tb_negara';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $primaryKey = 'kode';
    protected $guarded = [];
}
