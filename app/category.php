<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    public function books(){
        return $this->hasMany("App\book");
    }
}
