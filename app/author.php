<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class author extends Model
{
    public function books(){
        return $this->belongsToMany("App\book","book_author");
    }

}
