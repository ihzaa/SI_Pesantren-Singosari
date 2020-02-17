<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class file_artikel extends Model
{
    public $timestamps = false;

    public function artikel()
    {
        return $this->belongsTo('App\artikel', 'id_artikel');
    }
}
