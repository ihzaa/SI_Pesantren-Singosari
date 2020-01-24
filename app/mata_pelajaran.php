<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mata_pelajaran extends Model
{
    protected $table = 'mata_pelajaran';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function pengajar_mata_pelajaran()
    {
        return $this->hasMany('App\pengajar_mata_pelajaran','id_mata_pelajaran');
    }

    public function mata_pelajaran_tahun_ajaran()
    {
        return $this->hasMany('App\mata_pelajaran_tahun_ajaran', 'id_mata_pelajaran');
    }
}
