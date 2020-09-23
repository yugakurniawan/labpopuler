<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $table = 'tb_title';
    public $timestamps = false;
    protected $primaryKey = 'kode';
    protected $guarded = [];

}
