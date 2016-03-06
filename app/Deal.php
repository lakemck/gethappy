<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    public function article()
    {

        return $this->belongsTo('App\Article');
    }

	protected $fillable = array('dealname', 'article_id', 'dayID');

    // protected $primaryKey = 'prime'; 
}
