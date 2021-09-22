<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    public function category(){
        return $this->belongsTo("App\category");
    }
    public function publisher()
    {
        return $this->belongsTo("App\publisher");
    }
    public function authors()
    {
        return $this->belongsToMany("App\author","book_author");
    }


    public function ratings()
    {
        return $this->hasMany("App\Rating");
    }

    public function rate()
    {
        return $this->ratings->isNotEmpty() ? $this->ratings()->sum("value") / $this->ratings()->count() : 0;
    }
}
