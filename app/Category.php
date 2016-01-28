<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function articles()
    {
        // return $this->belongsToMany('App\Article')->withTimestamps();
        return $this->belongsToMany('App\Article')->withPivot('id')->withTimestamps();
    }

protected $fillable = array('name'); 
}
