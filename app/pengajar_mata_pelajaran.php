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
        return $this->hasMany('App\khs');
    }

    public function pembelajaran()
    {
        return $this->hasMany('App\pembelajaran');
    }

    public function pengajar()
    {
        return $this->belongsTo('App\pengajar');
    }

    public function tahun_ajaran()
    {
        return $this->belongsTo('App\tahun_ajaran');
    }

    public function mata_pelajaran()
    {
        return $this->belongsTo('App\mata_pelajaran');
    }
}
