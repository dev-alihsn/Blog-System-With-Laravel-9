<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminControllers\DashboardController;
use App\Http\Controllers\AdminControllers\AdminPostsController;
use App\Http\Controllers\AdminControllers\TinymceController;
use GuzzleHttp\Psr7\Request;

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

// Front user routes

Route::get('/', [\App\Http\Controllers\HomeController::class,'index'])->name('home');

Route::get('/posts/{post:slug}',[PostsController::class,'show'])->name('posts.show');

Route::post('/posts/{post:slug}',[PostsController::class,'addComment'])->name('posts.add_comment');

Route::get('/about', AboutController::class)->name('about');

Route::get('/contact',[ContactController::class,'create'])->name('contact.create');
Route::post('/contact',[ContactController::class,'store'])->name('contact.store');

Route::get('/category/{category:slug}',[CategoryController::class,'show'])->name('categories.show');
Route::get('/categories',[CategoryController::class,'index'])->name('categories.index');

Route::get('/tag/{tag:name}',[TagController::class,'show'])->name('tags.show');

require __DIR__.'/auth.php';


// Admin dashboard routes
Route::prefix('admin')->name('admin.')->middleware(['auth','IsAdmin'])->group(function(){
    Route::get('/',[DashboardController::class,'index'])->name('index');
    Route::post('upload_tinymce_image',[TinymceController::class,'upload_tinymce_image'])->name('upload_tinymce_image');
    Route::resource('posts',AdminPostsController::class);
});