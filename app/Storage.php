<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected $table = 'storage';

    public function components()
    {
        return $this->hasMany('App\Component');
    }
}
