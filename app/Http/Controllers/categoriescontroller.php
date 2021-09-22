<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;

class categoriescontroller extends controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required']);
    
        $category = new category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
    
        session()->flash('flash_message',  'تمت إضافة التصنيف بنجاح');
    
        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        $this->validate($request, ['name' => 'required']);
    
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
    
        session()->flash('flash_message',  'تمت تعديل التصنيف بنجاح');
    
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        $category->delete();
        session()->flash('flash_message', 'تم حذف التصنيف بنجاح');
        return redirect(route('categories.index'));
    }

    public function result(category $category)
    {
        $books = $category->books()->paginate(12);
        $title = 'الكتب التابعة لتصنيف: ' . $category->name;
        return view('gallery', compact('books', 'title'));
    }

    public function list()
    {
        $categories = category::all()->sortBy('name');
        $title = 'التصنيفات';
        return view('categories.index', compact('categories', 'title'));
    }

    public function search(Request $request)
    {
        $categories = category::where('name', 'like', "%{$request->term}%")->get()->sortBy('name');
        $title = ' نتائج البحث عن: ' . $request->term;
        return view('categories.index', compact('categories', 'title'));
    }
}
