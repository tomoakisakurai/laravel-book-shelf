<?php

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

Route::get('/healthcheck', function () {
    return view('welcome');
});

Route::get('/', function () {
    // $books = Book::all();
    $books2 = DB::table('books')->select('id', 'title')->groupBy('id')->get();
    // dd($books2);
    return view('books', ['books' => $books2]);
})->middleware('auth');

Route::get('tests/test', 'TestController@index');

Route::post('/book', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);
    $book = new Book;
    $book->title = $request->name;
    $book->save();

    return redirect('/');
});

Route::delete('/book/{book}', function (Book $book) {
    $book->delete();
    return redirect('/');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
