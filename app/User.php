<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\rating;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function isadmin(){

        return $this->administration_level > 0 ? true : false;
    
    }
    public function issuperadmin(){
        return $this->administration_level > 0 ? true : false;
    }

    public function ratings()
    {
        return $this->hasMany('App\rating');
    }

    public function rated(book $book)
    {
        return $this->ratings->where('book_id', $book->id)->isNotEmpty();
    }

    public function bookrating(book $book)
    {
        return $this->rated($book) ? $this->ratings->where('book_id', $book->id)->first() : NULL;
    }
    public function booksincart(){

        return $this->belongsToMany("App\book")->withPivot(["number_of_copies","bought"])->wherePivot("bought",FALSE);
    }

    public function ratedpurches()
    {
        return $this->belongsToMany('App\book')->withPivot(['bought'])->wherePivot('bought', true);
    }
}
