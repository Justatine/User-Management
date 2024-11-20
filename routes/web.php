<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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
    Route::get('/dashboard', [UserController::class, '__invoke']); 
    Route::post('/add/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}',[UserController::class, 'show'])->name('user.edit');
    Route::put('/user/{id}',[UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}',[UserController::class, 'destroy'])->name('user.destroy');
}); 

Route::middleware(['auth','is_client'])->group(function(){
    Route::get('/home', [UserController::class, 'gotoClientPage']); 
}); 