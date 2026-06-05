<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;

Route::middleware('guest')->group(function () {

    Route::get('/', function () {
        return view('auth.register');
    })->name('registerForm');

    Route::get('/loginForm', function () {
        return view('auth.login');
    })->name('loginForm');

    Route::post('/register',[AuthController::class,'register'])->name('register');

    Route::post('/login',[AuthController::class,'login'])->name('login');
});


Route::middleware('auth')->group(function () {

    // CRUD routes for blog post
    Route::resource('posts', PostController::class);
    Route::get('/posts/all', [PostController::class, 'allPosts'])->name('posts.all');

    // logout
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');

    // comments
    Route::post('/posts/{post}/comments',[CommentController::class,'storeComment'])->name('comments.store');

    Route::get('/add/comment',function(){
        return view('stuffs.comment');
    })->name('addComment');

    Route::get('/comments/{comment}/edit',[CommentController::class,'editComment'])->name('comments.edit');

    Route::put('/comments/{comment}',[CommentController::class,'updateComment'])->name('comments.update');

    Route::delete('/comments/{comment}',[CommentController::class,'deleteComment'])->name('comments.delete');
});

