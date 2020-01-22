<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengajar_mata_pelajaran extends Model
{
    protected $table = 'pengajar_mata_pelajaran';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function khs()
    {
        return $this->hasMany('App\khs','id_pengajar_mata_pelajaran');
    }

    public function pembelajaran()
    {
        return $this->hasMany('App\pembelajaran','id_pengajar_mata_pelajaran');
    }

    public function pengajar()
    {
        return $this->belongsTo('App\pengajar','id_pengajar');
    }

    public function tahun_ajaran()
    {
        return $this->belongsTo('App\tahun_ajaran','id_tahun_ajaran');
    }

    public function mata_pelajaran()
    {
        return $this->belongsTo('App\mata_pelajaran','id_mata_pelajaran');
    }
}
