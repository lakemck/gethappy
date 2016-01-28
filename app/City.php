<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function articles()
    {
        return $this->hasMany('Article');
    }
}
