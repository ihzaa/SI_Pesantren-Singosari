<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class khs extends Model
{
    protected $table = 'khs';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function santri()
    {
        return $this->belongsTo('App\santri','id_santri');
    }

    public function kelas()
    {
        return $this->belongsTo('App\kelas','id_kelas');
    }

    public function pengajar_mata_pelajaran()
    {
        return $this->belongsTo('App\pengajar_mata_pelajaran','id_pengajar_mata_pelajaran');
    }
}
