<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\CategoryController;
use  \App\Http\Controllers\Admin\ProductController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->group(function (){
    Route::get('/dashboard', [HomeController::class ,'index'] );

    Route::get('categories', [CategoryController::class ,'index'] )->name('category.index');
    Route::get('create-category', [CategoryController::class ,'create'] )->name('category.create');
    Route::post('store-category', [CategoryController::class ,'store'] )->name('category.store');
    Route::get('edit-category/{id}', [CategoryController::class ,'edit'] )->name('category.edit');
    Route::put('update-category/{id}', [CategoryController::class ,'update'] )->name('category.update');
    Route::get('delete-category/{id}', [CategoryController::class ,'destroy'] )->name('category.delete');

    Route::get('products', [ProductController::class ,'index'] )->name('product.index');
    Route::get('create-product', [ProductController::class ,'create'] )->name('product.create');
    Route::post('store-product', [ProductController::class ,'store'] )->name('product.store');
});
