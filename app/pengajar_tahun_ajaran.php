<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengajar_tahun_ajaran extends Model
{
    protected $table = 'pengajar_tahun_ajaran';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function pengajar()
    {
        return $this->belongsTo('App\pengajar','id_pengajar');
    }

    public function tahun_ajaran()
    {
        return $this->belongsTo('App\tahun_ajaran','id_tahun_ajaran');
    }
}
