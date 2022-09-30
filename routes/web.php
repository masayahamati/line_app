<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

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


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';



Route::get("/whole","App\Http\Controllers\ChatController@whole")->name("whole");

Route::get("/image_store/{id}","App\Http\Controllers\ChatController@image_store")->name("image_store");

Route::get("/{id}","App\Http\Controllers\ChatController@index")->name("index");

Route::post("/friend_serch","App\Http\Controllers\ChatController@friend_serch")->name("friend_serch");

Route::post("/request_permit","App\Http\Controllers\ChatController@request_permit")->name("request_permit");

Route::post("/store","App\Http\Controllers\ChatController@store")->name("store");

Route::post("/upload","App\Http\Controllers\ChatController@upload")->name("upload");




