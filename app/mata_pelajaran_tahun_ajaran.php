<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mata_pelajaran_tahun_ajaran extends Model
{
    protected $table = 'mata_pelajaran_tahun_ajaran';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function mata_pelajaran()
    {
        return $this->belongsTo('App\mata_pelajaran', 'id_mata_pelajaran');
    }

    public function tahun_ajaran()
    {
        return $this->belongsTo('App\tahun_ajaran', 'id_tahun_ajaran');
    }
}
