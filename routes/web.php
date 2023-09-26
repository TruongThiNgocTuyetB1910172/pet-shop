<?php

use App\Http\Controllers\Admin\AnimalDetailController ;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServicePackageController;
use App\Http\Controllers\Client\ClientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use  App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Client\ProductContronller;
use App\Http\Controllers\Client\ServiceContronller;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Admin\VariantServiceController;
use \App\Http\Controllers\Client\NewAddressController;
use \App\Http\Controllers\SocialiteController;
use \App\Http\Controllers\Client\ClientOrderController;
use \App\Http\Controllers\Admin\OrderController;
use \App\Http\Controllers\Admin\ReceiptController;


Auth::routes(['verify' => true]);

Route::get('auth/{provider}/redirect', [SocialiteController::class, 'redirect'])->name('socialite.redirect');
Route::get('auth/{provider}/callback', [SocialiteController::class, 'callback'])->name('socialite.callback');


Route::get('/', [ClientController::class, 'index']) ->name('home');
Route::get('products-list', [ProductContronller::class, 'index'])->name('product-list.index');
Route::get('services-list', [ServiceContronller::class, 'index'])->name('service-list.index');
Route::get('product-detail/{id}', [ProductContronller::class, 'detail'])->name('product-list.detail');

Route::post('cart/{id}', [ProductContronller::class,'addToCart'])->name('cart.add-to-cart')->middleware(['auth', 'verified']);
Route::get('cart-list', [CartController::class,'index'])->name('cart-list.index');
Route::put('cart-update',[CartController::class, 'update'])->name('cart-update');
Route::get('cart-delete/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('order-product', [ClientOrderController::class,'index'])->name('order-product.index');
Route::get('purchase-history', [ClientOrderController::class, 'history'])->name('purchase.history');
Route::get('detail-history/{id}', [ClientOrderController::class, 'detail'])->name('history.detail');

Route::get('location', [NewAddressController::class ,'index'])->name('location.new-add');
Route::get('address-delete/{id}', [CartController::class,'delete'])->name('address.delete');

Route::middleware(['auth', 'admin', 'activated', 'verified'])->group(function () {
    Route::get('/dashboard', [HomeController::class ,'index']);

    Route::get('categories', [CategoryController::class ,'index'])->name('category.index');
    Route::get('create-category', [CategoryController::class ,'create'])->name('category.create');
    Route::post('store-category', [CategoryController::class ,'store'])->name('category.store');
    Route::get('edit-category/{id}', [CategoryController::class ,'edit'])->name('category.edit');
    Route::put('update-category/{id}', [CategoryController::class ,'update'])->name('category.update');
    Route::get('delete-category/{id}', [CategoryController::class ,'destroy'])->name('category.destroy');

    Route::get('products', [ProductController::class ,'index'])->name('product.index');
    Route::get('create-product', [ProductController::class ,'create'])->name('product.create');
    Route::post('store-product', [ProductController::class ,'store'])->name('product.store');
    Route::get('edit-product/{id}', [ProductController::class ,'edit'])->name('product.edit');
    Route::put('update-product/{id}', [ProductController::class ,'update'])->name('product.update');
    Route::get('delete-product/{id}', [ProductController::class ,'destroy'])->name('product.destroy');
    Route::get('delete-product-image/{id}', [ProductController::class ,'deleteProductImage'])->name('product.delete-image');

    Route::get('users', [UserController::class ,'index'])->name('user.index');
    Route::get('create-user', [UserController::class ,'create'])->name('user.create');
    Route::post('store-user', [UserController::class ,'store'])->name('user.store');
    Route::get('edit-user/{id}', [UserController::class ,'edit'])->name('user.edit');
    Route::put('update-user/{id}', [UserController::class ,'update'])->name('user.update');
    Route::put('update-user-password/{id}', [UserController::class ,'updatePassword'])->name('user.update-password');

    Route::get('profiles', [ProfileController::class, 'index'])->name('profile.index');

    Route::get('banners', [BannerController::class, 'index'])->name('banner.index');
    Route::get('create-banner', [BannerController::class ,'create'])->name('banner.create');
    Route::post('store-banner', [BannerController::class ,'store'])->name('banner.store');
    Route::get('edit-banner/{id}', [BannerController::class ,'edit'])->name('banner.edit');
    Route::put('update-banner/{id}', [BannerController::class ,'update'])->name('banner.update');
    Route::get('delete-banner/{id}', [BannerController::class ,'destroy'])->name('banner.destroy');

    Route::get('services', [ServiceController::class, 'index'])->name('service.index');
    Route::get('create-service', [ServiceController::class ,'create'])->name('service.create');
    Route::post('store-service', [ServiceController::class ,'store'])->name('service.store');
    Route::get('edit-service/{id}', [ServiceController::class ,'edit'])->name('service.edit');
    Route::put('update-service/{id}', [ServiceController::class ,'update'])->name('service.update');
    Route::get('delete-service/{id}', [ServiceController::class ,'destroy'])->name('service.destroy');

    Route::get('variant-services', [VariantServiceController::class, 'index'])->name('variant-service.index');
    Route::get('create-variant-service', [VariantServiceController::class ,'create'])->name('variant-service.create');
    Route::post('store-variant-service', [VariantServiceController::class ,'store'])->name('variant-service.store');
    Route::get('edit-variant-service/{id}', [VariantServiceController::class ,'edit'])->name('variant-service.edit');
    Route::put('update-variant-service/{id}', [VariantServiceController::class ,'update'])->name('variant-service.update');
    Route::get('delete-variant-service/{id}', [VariantServiceController::class ,'destroy'])->name('variant-service.destroy');

    Route::get('package-services', [ServicePackageController::class, 'index'])->name('package-service.index');
    Route::get('create-package-service', [ServicePackageController::class ,'create'])->name('package-service.create');
    Route::post('store-package-service', [ServicePackageController::class ,'store'])->name('package-service.store');
    Route::get('edit-package-service/{id}', [ServicePackageController::class ,'edit'])->name('package-service.edit');
    Route::put('update-package-service/{id}', [ServicePackageController::class ,'update'])->name('package-service.update');
    Route::get('delete-package-service/{id}', [ServicePackageController::class ,'destroy'])->name('package-service.destroy');

    Route::get('appointments', [AppointmentController::class, 'index'])->name('appointment.index');
    Route::get('create-appointment', [AppointmentController::class ,'create'])->name('appointment.create');
    Route::post('store-appointment', [AppointmentController::class ,'store'])->name('appointment.store');
    Route::get('edit-appointment/{id}', [AppointmentController::class ,'edit'])->name('appointment.edit');
    Route::put('update-appointment/{id}', [AppointmentController::class ,'update'])->name('appointment.update');
    Route::get('delete-appointment/{id}', [AppointmentController::class ,'destroy'])->name('appointment.destroy');

    Route::get('animal-details', [AnimalDetailController::class, 'index'])->name('animal-detail.index');
    Route::get('create-animal-detail', [AnimalDetailController::class ,'create'])->name('animal-detail.create');
    Route::post('store-animal-detail', [AnimalDetailController::class ,'store'])->name('animal-detail.store');
    Route::get('edit-animal-detail/{id}', [AnimalDetailController::class ,'edit'])->name('animal-detail.edit');
    Route::put('update-animal-detail/{id}', [AnimalDetailController::class ,'update'])->name('animal-detail.update');
    Route::get('delete-animal-detail/{id}', [AnimalDetailController::class ,'destroy'])->name('animal-detail.destroy');

    Route::get('order', [OrderController::class,'index'])->name('order.index');
    Route::get('edit-order/{id}', [OrderController::class,'edit'])->name('order.edit');
    Route::put('update-order/{id}', [OrderController::class,'update'])->name('order.update');

    Route::get('receipt', [ReceiptController::class, 'index'])->name('receipt.index');
    Route::get('receipt', [ReceiptController::class, 'create'])->name('receipt.create');

});
