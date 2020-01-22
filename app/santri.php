<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class santri extends Model
{
    protected $table = 'santri';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function data_per_kelas()
    {
        return $this->hasMany('App\data_per_kelas','id_santri');
    }

    public function khs()
    {
        return $this->hasMany('App\khs','id_santri');
    }

    public function user()
    {
        return $this->belongsTo('App\user','id_user');
    }

}
