<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tahun_ajaran extends Model
{
    protected $table = 'tahun_ajaran';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function pengajar_mata_pelajaran()
    {
        return $this->hasMany('App\pengajar_mata_pelajaran');
    }
}
