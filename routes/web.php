<?php

use App\Http\Controllers\Blog\PostsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WelcomeController;
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

Route::get('/',[WelcomeController::class,'index']);
Route::get('blog/posts/{post}',[PostsController::class,'show'])->name('blog.show');

Auth::routes();

Route::middleware(['auth'])->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('categories',CategoriesController::class);

    Route::resource('tags', TagsController::class);

    Route::resource('posts',PostController::class);

    Route::get('trashed-posts',[PostController::class,'trashed'])->name('trashed-posts.index');

    Route::put('restore-post/{post}',[PostController::class, 'restore'])->name('restore-posts');
});

Route::middleware(['auth','admin'])->group(function(){
    Route::get('users/profile',[UsersController::class,'edit'])->name('users.edit-profile');
    Route::put('users/profile',[UsersController::class,'update'])->name('users.update-profile');
    Route::get('users',[UsersController::class,'index'])->name('users.index');
    Route::post('users/{user}/make-admin',[UsersController::class,'makeAdmin'])->name('users.make-admin');
});

