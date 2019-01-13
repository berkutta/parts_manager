<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Storage extends Model
{
    protected $table = 'storage';
    protected $fillable = ['name'];

    public function components()
    {
        return $this->hasMany('App\Component');
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
