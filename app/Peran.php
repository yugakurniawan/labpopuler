<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peran extends Model
{
    protected $table = "peran";
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
