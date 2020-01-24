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
        return $this->hasMany('App\pengajar_mata_pelajaran', 'id_tahun_ajaran');
    }

    public function kelas_tahun_ajaran()
    {
        return $this->hasMany('App\kelas_tahun_ajaran', 'id_tahun_ajaran');
    }
    public function mata_pelajaran_tahun_ajaran()
    {
        return $this->hasMany('App\mata_pelajaran_tahun_ajaran', 'id_tahun_ajaran');
    }
    public function pengajar_tahun_ajaran()
    {
        return $this->hasMany('App\pengajar_tahun_ajaran', 'id_tahun_ajaran');
    }
}
