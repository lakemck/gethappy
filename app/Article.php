<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Article extends Model
{

    public function categories()
        {
            // return $this->belongsToMany('App\Category')->withPivot('id')->withTimestamps();
            return $this->belongsToMany('App\Category')->withTimestamps();
        }

    public function getCategoryListAttribute()
        {
            return $this->categories->lists('id')->all();
        }

            public function days()
        {
            return $this->belongsToMany('App\Day')->withTimestamps();
        }

    public function getDayListAttribute()
        {
            return $this->days->lists('id')->all();
        }
        
    public function deals()
    {
        return $this->hasMany('App\Deal');
        
    }  

    public function getDealListAttribute()
        {
            return $this->deals->lists('id')->all();
        } 

    // public function city()
    // {
    //     return $this->belongsTo('City');
    // }

    // public function scopeSearch($categoryChoice, $categoryList){

    //     return $categoryChoice->where('$catIDs', 'LIKE', "%$categoryList%" );

    // }


// https://www.reddit.com/r/laravel/comments/2q6vcd/handling_lat_lng/
        // UNSURE ABOUT DISTANCE.
// public function scopeDistance($lat, $lng, $distance)
//     {
//       $query = DB::select(DB::raw('SELECT id, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians(' . $lng . ') ) + sin( radians(' . $lat .') ) * sin( radians(lat) ) ) ) AS distance FROM articles HAVING distance < ' . $distance . ' ORDER BY distance') );

//       return $query;
//     }

public function scopeDistance($query, $lat, $lng, $radius = 10000)
{
    $unit = 6378.10;
    $lat = (float) $lat;
    $lng = (float) $lng;
    $radius = (double) $radius;
    return $query->having('distance','<=',$radius)
                ->select(DB::raw("*,
                            ($unit * ACOS(COS(RADIANS($lat))
                                * COS(RADIANS(lat))
                                * COS(RADIANS($lng) - RADIANS(lng))
                                + SIN(RADIANS($lat))
                                * SIN(RADIANS(lat)))) AS distance")
                )->orderBy('distance','asc');
}
  


protected $fillable = array('title', 'deal', 'description', 'image', 'email', 'address', 'phone', 'website', 'rating', 'lat', 'lng');

// use SoftDeletes;

 
    // protected $dates = ['deleted_at'];

}
