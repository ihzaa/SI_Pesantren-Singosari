<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data_per_kelas extends Model
{
    protected $table = 'data_per_kelas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function kelas()
    {
        return $this->belongsTo('App\kelas');
    }

    public function santri()
    {
        return $this->belongsTo('App\santri');
    }
}
