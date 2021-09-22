<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
#لوحة التحكم
Route::prefix('/admin')->middleware('can:update-books')->group(function() {
    Route::get('/', 'adminscontroller@index')->name('admin.index'); 

    Route::resource('/books', 'bookscontroller');
    Route::resource('/categories', 'categoriescontroller');
    Route::resource('/publishers', 'publisherscontroller');
    Route::resource('/authors', 'authorscontroller');
    Route::resource('/users', 'userscontroller')->middleware('can:update-users');
});
#الرئيسية
Route::get('/main', 'maincontroller@index')->name('main.index');

#البحث
Route::get('/', 'gallerycontroller@index')->name('gallery.index');

Route::get('/search', 'galleryController@search')->name('search');
#تفاصيل الكتاب والتقييمات
Route::get('/book/{book}', 'bookscontroller@details')->name('book.details');
Route::post('/book/{book}/rate','bookscontroller@rate')->name('book.rate');
#الاقسام
Route::get('/categories', 'categoriescontroller@list')->name('gallery.categories.index');
Route::get('/categories/search', 'categoriescontroller@search')->name('gallery.categories.search');
Route::get('/categories/{category}', 'categoriescontroller@result')->name('gallery.categories.show');
#الناشرين
Route::get('/publishers', 'publisherscontroller@list')->name('gallery.publishers.index');
Route::get('/publishers/search', 'publisherscontroller@search')->name('gallery.publishers.search');
Route::get('/publishers/{publisher}', 'publisherscontroller@result')->name('gallery.publishers.show');
#المؤلفين
Route::get('/authors', 'authorscontroller@list')->name('gallery.authors.index');
Route::get('/authors/search', 'authorscontroller@search')->name('gallery.authors.search');
Route::get('/authors/{author}', 'authorscontroller@result')->name('gallery.authors.show');
#سله الشراء
Route::post('/cart', 'cartcontroller@addtocart')->name('cart.add');
Route::get('/cart', 'cartcontroller@viewcart')->name('cart.view');
Route::post('/removeone/{book}', 'cartcontroller@removeone')->name('cart.remove_one');
Route::post('/removeall/{book}', 'cartcontroller@removeall')->name('cart.remove_all');
