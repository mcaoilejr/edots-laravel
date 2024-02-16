<?php

use Illuminate\Support\Facades\Route;
use App\Models\Document;


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
Route::get('/qr/{id}', function ($id) {
    if (!auth()->check()) {
        return view('invalid');
    }
    $rec = Document::find($id);
    return view('qr',[
        "link"=>"https://edots.depedkidapawancity.net/document/". $id ."/view",
        'title'=> $rec->title,
        'date'=> $rec->created_at,
        'type'=> $rec->documenttype_id,
        'code'=> $rec->documentcode,
    ]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\PageController::class, 'dashboard'])->name('dashboard');
Route::get('/document/{id}/view', [App\Http\Controllers\DocumentController::class, 'show'])->name('showdocument ');
