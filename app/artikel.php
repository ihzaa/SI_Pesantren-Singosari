<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class artikel extends Model
{
    public function file_artikel()
    {
        return $this->hasMany('App\file_artikel','id_artikel');
    }
}
