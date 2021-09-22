<?php

namespace App\Http\Controllers;

use App\book;
use Illuminate\Http\Request;

class cartcontroller extends controller
{
   public function __construct() 
   {
        $this->middleware('auth');
   } 

    public function addtocart(Request $request)
    {
            
        $book = book::find($request->id);
        
        if(auth()->user()->booksincart->contains($book)) {
            $newquantity = $request->quantity + auth()->user()->booksincart()->where('book_id', $book->id)->first()->pivot->number_of_copies;
            if($newquantity > $book->number_of_copies) {
                session()->flash('warning_message',  'لم تتم إضافة الكتاب، لقد تجاوزت عدد النسخ الموجودة لدينا، أقصى عدد موجود بإمكانك حجزه من هذا الكتاب هو ' . ($book->number_of_copies->auth()->user()->booksincart()->where('book_id', $book->id)->first()->pivot->number_of_copies) . ' كتاب');
                return redirect()->back();
            } else {
                auth()->user()->booksincart()->updateExistingPivot($book->id, ['number_of_copies'=> $newquantity]);
            }
                
        } else {
            auth()->user()->booksincart()->attach($request->id, ['number_of_copies'=> $request->quantity]);
        }

        return redirect()->back();

    }

    public function viewcart()
    {
        $items = auth()->user()->booksincart;
        return view('cart', compact('items'));
    }

    public function removeone(book $book) {
        $oldquantity = auth()->user()->booksincart()->where('book_id', $book->id)->first()->pivot->number_of_copies;
        if($oldquantity > 1) {
            auth()->user()->booksincart()->updateExistingPivot($book->id, ['number_of_copies'=> $oldquantity]);
        } else {
            auth()->user()->booksincart()->detach($book->id);
        }

        return redirect()->back();
    }

    public function removeall(book $book) {
        auth()->user()->booksincart()->detach($book->id);

        return redirect()->back();
    }

  
}
