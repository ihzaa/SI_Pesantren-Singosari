<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengajar extends Model
{
    protected $table = 'pengajar';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\user','id_user');
    }

    public function pengajar_mata_pelajaran()
    {
        return $this->hasMany('App\pengajar_mata_pelajaran','id_pengajar');
    }
}
