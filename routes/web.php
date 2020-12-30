<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

//dashboard
//Route::prefix('admin')->group(function (){
//
//    Route::get('/main', function () {
//    return view('dashboard.dashboard');
//});
//});





Route::get('/', function () {
    return view('pages.index');
})->name('pages.index');


Route::get('cart', function () {
    return view('pages.cart');
})->name('pages.cart');


Route::get('login', [\App\Http\Controllers\AuthController::class,'login'])->name('login');
Route::post('authenticate', [\App\Http\Controllers\AuthController::class,'authenticate'])->name('authenticate');
Route::get('logout', [\App\Http\Controllers\AuthController::class,'logout'])->name('logout');



Route::get('single', function () {
    return view('pages.single_product');
})->name('pages.single');



Route::get('/viewProduct',[\App\Http\Controllers\ProductController::class,'view'])->name('pages.list');
Route::get('/viewBlog',[\App\Http\Controllers\BlogController::class,'view'])->name('pages.blog');


//Dashboard

Route::middleware('auth')->group(function (){
    Route::get('/main', function () {
        return view('dashboard.dashboard');
    })->name('dashboard.dashboard');

    Route::resource('users',\App\Http\Controllers\UserController::class);
    Route::resource('products',\App\Http\Controllers\ProductController::class);
    Route::resource('carts',\App\Http\Controllers\CartController::class);
    Route::resource('blogs',\App\Http\Controllers\BlogController::class);

});


