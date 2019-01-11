<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Component extends Model
{
    protected $table = 'components';

    use \Spatie\Tags\HasTags;

    public function storage() 
    {
        return $this->belongsTo('App\Storage');
    }

    public function save(array $options = array())
    {
        if( ! $this->user_id)
        {
            $this->user_id = Auth::user()->id;
        }

        parent::save($options);
    }
}
