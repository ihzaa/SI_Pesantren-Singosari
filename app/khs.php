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
        return $this->belongsTo('App\santri');
    }

    public function kelas()
    {
        return $this->belongsTo('App\kelas');
    }

    public function pengajar_mata_pelajaran()
    {
        return $this->belongsTo('App\pengajar_mata_pelajaran');
    }
}
