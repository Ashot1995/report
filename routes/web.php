<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

//generate short link
Route::controller(\App\Http\Controllers\ShortUrlController::class)->middleware('auth')->group(function () {
    Route::get('generate-shorten-link', 'indexAction');
    Route::post('generate-shorten-link', 'storeAction')->name('generate.shorten.link.post');

    Route::get('{code}', 'shortenLinkAction')->name('shorten.link');

    //download csv
    Route::get('/download-csv', 'downloadCsvAction');
});
