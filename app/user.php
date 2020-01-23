<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    protected $table = 'user';
    protected $fillable = ['username','role'];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function santri()
    {
        return $this->hasMany('App\santri','id_user');
    }

    public function admin()
    {
        return $this->hasMany('App\admin','id_user');
    }

    public function pengajar()
    {
        return $this->hasMany('App\pengajar','id_user');
    }
}
