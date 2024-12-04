<?php

use App\Http\Controllers\GIFController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CommentController;

Route::get('/', [AuthController::class, '__invoke']); 
Route::get('/sign-in', [AuthController::class, 'gotoSignIn'])->name('login'); 
Route::get('/sign-up', [AuthController::class, 'gotoSignUp']); 

Route::post('/login', [AuthController::class, 'login']); 
Route::post('/register', [AuthController::class, 'register']); 

Route::middleware(['auth','is_authenticated'])->group(function(){
    Route::get('/admin', [UserController::class, '__invoke']); 
    Route::get('/profile',[AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');   
});     

Route::middleware(['auth','is_admin'])->group(function(){
    // Users
    Route::get('/dashboard', [UserController::class, '__invoke']); 
    Route::post('/add/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}',[UserController::class, 'show'])->name('user.edit');
    Route::put('/user/{id}',[UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}',[UserController::class, 'destroy'])->name('user.destroy');

    // Gifs
    Route::get('/gifs-images', [GIFController::class, '__invoke'])->name('gifs-images');
    Route::post('/admin/images', [GIFController::class, 'store'])->name('admin.images.store');
    Route::delete('/admin/images/{image}', [GIFController::class, 'destroy'])->name('admin.images.destroy');
    Route::put('/admin/images/{image}', [GIFController::class, 'update'])->name('admin.images.update');
}); 

Route::middleware(['auth','is_client'])->group(function(){
    Route::get('/home', [UserController::class, 'gotoClientPage']); 
    
    // Gifs
    Route::get('/home/gifs-images', [GIFController::class, 'home']);  
}); 

Route::get('/gif/download/{gif}', [GIFController::class, 'download'])->name('gif.download');
Route::post('/favorites/{gif}', [GIFController::class, 'toggleFavorite'])->name('gif.favorite');

Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index');

Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

Route::get('/gifs/{gif}/comments', [GifController::class, 'comments'])->name('gif.comments');
Route::post('/gifs/{gif}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::get('/images', [GIFController::class, 'home'])->name('images.index');