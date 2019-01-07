<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $table = 'components';

    use \Spatie\Tags\HasTags;

    public function storage() 
    {
        return $this->belongsTo('App\Storage');
    }
}
