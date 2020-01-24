<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kelas_tahun_ajaran extends Model
{
    protected $table = 'kelas_tahun_ajaran';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function kelas()
    {
        return $this->belongsTo('App\kelas', 'id_kelas');
    }

    public function tahun_ajaran()
    {
        return $this->belongsTo('App\tahun_ajaran', 'id_tahun_ajaran');
    }
}
