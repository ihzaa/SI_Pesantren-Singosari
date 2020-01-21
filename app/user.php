<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function santri()
    {
        return $this->hasMany('App\santri');
    }

    public function admin()
    {
        return $this->hasMany('App\admin');
    }

    public function pengajar()
    {
        return $this->hasMany('App\pengajar');
    }
}
