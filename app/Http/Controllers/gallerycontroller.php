<?php

namespace App\Http\Controllers;

use App\book;
use Illuminate\Http\Request;

class gallerycontroller extends controller
{
    public function index()
    {
        $books = book::Paginate(12);
        $title = '';
        return view('gallery', compact('books', 'title'));
    }

    public function search(Request $request)
    {
        $books = book::where('title', 'like', "%{$request->term}%")->paginate(12);
        $title = ' عرض نتائج البحث عن: ' . $request->term;
        return view('gallery', compact('books', 'title'));
    }
}
