<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\CategoryController;
use  \App\Http\Controllers\Admin\ProductController;
use \App\Http\Controllers\Admin\ProvinceController;
use \App\Http\Controllers\Admin\DistrictController;
use \App\Http\Controllers\Admin\WardController;

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
    Route::get('edit-product/{id}', [ProductController::class ,'edit'] )->name('product.edit');
    Route::put('update-product/{id}', [ProductController::class ,'update'] )->name('product.update');
    Route::get('delete-product/{id}', [ProductController::class ,'destroy'] )->name('product.destroy');

    Route::get('provinces', [ProvinceController::class ,'index'] )->name('province.index');
    Route::get('create-province', [ProvinceController::class ,'create'] )->name('province.create');
    Route::post('store-province', [ProvinceController::class ,'store'] )->name('province.store');
    Route::get('edit-province/{id}', [ProvinceController::class ,'edit'] )->name('province.edit');
    Route::put('update-province/{id}', [ProvinceController::class ,'update'] )->name('province.update');
    Route::get('delete-province/{id}', [ProvinceController::class ,'destroy'] )->name('province.delete');

    Route::get('districts', [DistrictController::class ,'index'] )->name('district.index');
    Route::get('create-district', [DistrictController::class ,'create'] )->name('district.create');
    Route::post('store-district', [DistrictController::class ,'store'] )->name('district.store');
    Route::get('edit-district/{id}', [DistrictController::class ,'edit'] )->name('district.edit');
    Route::put('update-district/{id}', [DistrictController::class ,'update'] )->name('district.update');
    Route::get('delete-district/{id}', [DistrictController::class ,'destroy'] )->name('district.delete');

    Route::get('wards', [WardController::class ,'index'] )->name('ward.index');
    Route::get('create-ward', [WardController::class ,'create'] )->name('ward.create');
    Route::post('store-ward', [WardController::class ,'store'] )->name('ward.store');
    Route::get('edit-ward/{id}', [WardController::class ,'edit'] )->name('ward.edit');
    Route::put('update-ward/{id}', [WardController::class ,'update'] )->name('ward.update');
    Route::get('delete-ward/{id}', [WardController::class ,'destroy'] )->name('ward.delete');
});
