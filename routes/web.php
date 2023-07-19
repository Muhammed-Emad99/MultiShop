<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//------------------------------------ Routes for all ------------------------------------
Route::get('/', [CategoryController::class,'home'])->name('/');

//------------------------- Auth --------------
Route::get('/auth/register',[AuthController::class,'register'])->name('auth.register');
Route::post('/auth/store',[AuthController::class,'store'])->name('auth.store');
Route::get('/auth/login',[AuthController::class,'login'])->name('auth.loginForm');
Route::post('/auth/save',[AuthController::class,'save'])->name('auth.login');

//------------------------------------ Routes for admins ------------------------------------
Route::middleware('isAdmin')->group(function (){
    Route::get('/categories/create', [CategoryController::class,'create'])->name('categories.create');
    Route::post('/categories/', [CategoryController::class,'store'])->name('categories.store');

    Route::get('/products/create', [ProductController::class,'create'])->name('products.create');
    Route::post('/products/', [ProductController::class,'store'])->name('products.store');
});

//------------------------------------ Routes for any users ------------------------------------
Route::middleware('isLoggedIn')->group(function (){
    Route::get('/categories/',[CategoryController::class,'index'])->name('categories.index');
    Route::get('/products/',[ProductController::class,'index'])->name('products.index');
    Route::get('/auth/logout',[AuthController::class, 'logout'])->name('auth.logout');
    Route::get('/auth/{user}',[AuthController::class, 'profile'])->name('auth.profile');
    Route::put('/auth/{user}',[AuthController::class, 'update'])->name('auth.update');
});


//------------------------------------ not Authenticated ------------------------------------
Route::get('notAuthenticated',function (){
    return redirect(route('auth.loginForm')) ;
});
