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

    public function updateStock($data)
    {
        if(preg_match('/\+(.*)/', $data, $output))
        {
            $this->stock += $output[1];
        }
        else if(preg_match('/\-(.*)/', $data, $output))
        {
            $this->stock -= $output[1];
        }
        else
        {
            $this->stock = $data;
        }
    }
}
