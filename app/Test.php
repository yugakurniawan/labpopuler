<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'tb_test1';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $primaryKey = 'kodetest';
    protected $guarded = [];
}
