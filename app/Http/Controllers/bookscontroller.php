<?php

namespace App\Http\Controllers;
use App\Rating;
use App\book;
use App\author;
use App\category;
use App\publisher;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Traits\ImageUploadTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
class bookscontroller extends Controller
{
    use ImageUploadTrait;
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $books = book::all();
        return view("admin.books.index" ,compact("books"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = author::all();
        $categories = category::all();
        $publishers = publisher::all();
        return view("admin.books.create" ,compact("categories","authors" ,"publishers"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'isbn' => ['required', 'alpha_num', Rule::unique('books', 'isbn')],
            'cover_image' => 'image|required', 
            'category' => 'nullable',
            'authors' => 'nullable',
            'publisher' => 'nullable',
            'description' => 'nullable',
            'publish_year' => 'numeric|nullable',
            'number_of_pages' => 'numeric|required',
            'number_of_copies' => 'numeric|required',
            'price' => 'numeric|required',
        ]);

        $book = new book;

        $book->title = $request->title;
        $book->cover_image = $this->uploadImage( $request->cover_image );
        $book->isbn = $request->isbn;
        $book->category_id = $request->category;
        $book->publisher_id = $request->publisher;
        $book->description = $request->description;
        $book->publisher_year = $request->publisher_year;
        $book->number_of_pages = $request->number_of_pages;
        $book->number_of_copies = $request->number_of_copies;
        $book->price = $request->price;

        $book->save();

        $book->authors()->attach($request->authors);

        session()->flash('flash_message', 'تمت إضافة الكتاب بنجاح');

        return redirect(route('books.show', $book));

      
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(book $book)
    {
        return view("admin.books.show" ,compact("book"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(book $book)
    {
        $authors = author::all();
        $categories= category::all();
        $publishers= publisher::all();
        return view("admin.books.edit" ,compact("book","categories","authors","publishers"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, book $book)
    {
        $this->validate($request,[
            'title' => 'required',
            'cover_image' => 'image|', 
            'category' => 'nullable',
            'authors' => 'nullable',
            'publisher' => 'nullable',
            'description' => 'nullable',
            'publisher_year' => 'numeric|nullable',
            'number_of_pages' => 'numeric|required',
            'number_of_copies' => 'numeric|required',
            'price' => 'numeric|required',
        ]);

        $book->title = $request->title;
        if($request->has("cover_image")){
            Storage::disk("public")->delete($book->cover_image);
            $book->cover_image = $this->uploadImage($request->cover_image);
        }
        $book->isbn = $request->isbn;
        $book->category_id = $request->category;
        $book->publisher_id = $request->publisher;
        $book->description = $request->description;
        $book->publisher_year = $request->publisher_year;
        $book->number_of_pages = $request->number_of_pages;
        $book->number_of_copies = $request->number_of_copies;
        $book->price = $request->price;

        $book->save();
        $book->authors()->detach();
        $book->authors()->attach($request->authors);

        session()->flash('flash_message', 'تم تعديل الكتاب بنجاح');

        return redirect(route('books.show', $book));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(book $book)
    {
        Storage::disk("public")->delete($book->cover_image);

        $book->delete();

        session()->flash('flash_message', ' تم حذف الكتاب بنجاح');

        return redirect(Route("books.index"));
    }
    public function details(Book $book)
    {   
        $bookfind = 0;
        if (Auth::check()) {
            $bookfind = auth()->user()->ratedpurches()->where('book_id', $book->id)->first();
        }
        return view('books.details', compact('book', 'bookfind'));
    }

    public function rate(request $request ,book $book)
    {
        if(auth()->user()->rated($book)){
            $rating = Rating::where(["user_id" => auth()->user()->id,"book_id" => $book->id])->first();
            $rating->value = $request->value;
            $rating->save();
        }else{
            $rating = new Rating;
            $rating->user_id = auth()->user()->id;
            $rating->book_id = $book->id;
            $rating->value = $request->value;
            $rating->save();
        }
        return back();
    }
}
