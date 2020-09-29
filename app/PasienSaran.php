<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasienSaran extends Model
{
    protected $table = 'tb_passaran';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $primaryKey = 'noreg';
    protected $guarded = [];
}