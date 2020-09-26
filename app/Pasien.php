<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'tb_pasien';
    public $timestamps = false;
    protected $primaryKey = 'noreg';
    protected $guarded = [];

    public function title()
    {
        return $this->belongsTo('App\Title', 'title_id');
    }
}
