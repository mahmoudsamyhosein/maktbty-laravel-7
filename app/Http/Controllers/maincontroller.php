<?php

namespace App\Http\Controllers;
use App\book;

use Illuminate\Http\Request;

class maincontroller extends Controller
{
    public function index()
    {
        
        return view("home.main");
    }
}
