<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $table = 'components';

    public function storage() 
    {
        return $this->belongsTo('App\Storage');
    }
}
