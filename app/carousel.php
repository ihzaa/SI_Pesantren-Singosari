<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class carousel extends Model
{
    protected $table = 'carousel';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
