<?php

namespace App\Http\Controllers;

use App\category;
use App\book;
Use App\author;
use App\publisher;

use Illuminate\Http\Request;

class adminscontroller extends Controller
{
    public function index(){
        $number_of_books= book::count();
        $number_of_categories= category::count();
        $number_of_publishers= publisher::count();
        $number_of_authors= author::count();

        return view("admin.index",compact("number_of_books","number_of_categories","number_of_publishers","number_of_authors"));
    }
}
