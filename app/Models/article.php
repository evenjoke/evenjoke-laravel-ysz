<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    protected $fillable=['title','content','author_id'];
    public function author()
    {
//        return $this->belongsTo('App\Models\Admin');
        return $this->belongsTo(user::class,'author_id','id');
    }
}
