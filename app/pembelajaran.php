<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pembelajaran extends Model
{
    protected $table = 'pembelajaran';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function kelas()
    {
        return $this->belongsTo('App\kelas','id_kelas');
    }

    public function pengajar_mata_pelajaran()
    {
        return $this->belongsTo('App\pengajar_mata_pelajaran','id_pengajar_mata_pelajaran');
    }
}
