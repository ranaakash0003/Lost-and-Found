<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

 protected $fillable = ['user_id','found','image','place','details','lat','lng','contact',];

 public function user(){

    return $this->belongsTo('App\User');

}



public function getImageAttribute($image){

    return asset($image);
}


}