<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    protected $table = 'kelas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function data_per_kelas()
    {
        return $this->hasMany('App\data_per_kelas', 'id_kelas');
    }

    public function pembelajaran()
    {
        return $this->hasMany('App\pembelajaran', 'id_kelas');
    }

    public function khs()
    {
        return $this->hasMany('App\khs', 'id_kelas');
    }

    public function kelas_tahun_ajaran()
    {
        return $this->hasMany('App\kelas_tahun_ajaran', 'id_kelas');
    }
}
