<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AnimalDetailController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FeedBackController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReceiptController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServicePackageController;
use App\Http\Controllers\Admin\ShipperController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VariantServiceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\ClientFeedBackController;
use App\Http\Controllers\Client\ClientOrderController;
use App\Http\Controllers\Client\NewAddressController;
use App\Http\Controllers\Client\ProductContronller;
use App\Http\Controllers\Client\ProductReviewController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\ServiceContronller;
use App\Http\Controllers\Client\ThanhYouController;
use App\Http\Controllers\Shipper\ShipperOrderController;
use App\Http\Controllers\Shipper\ShipperProfileController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\VnPayController;
use App\Http\Controllers\Client\Wishlistcontroller;
use App\Http\Controllers\Admin\ThongKeController;
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

Auth::routes(['verify' => true]);

Route::get('auth/{provider}/redirect', [SocialiteController::class, 'redirect'])->name('socialite.redirect');
Route::get('auth/{provider}/callback', [SocialiteController::class, 'callback'])->name('socialite.callback');

Route::get('/admin/login', [LoginController::class,'showAdminLoginForm'])->name('admin.login-view');
Route::post('/admin/login', [LoginController::class,'adminLogin'])->name('admin.login');

Route::get('/shipper/login', [LoginController::class,'showShipperLoginForm'])->name('shipper.login-view');
Route::post('/shipper/login', [LoginController::class,'shipperLogin'])->name('shipper.login');

Route::get('/', [ClientController::class, 'index']) ->name('home');
Route::get('products-list', [ProductContronller::class, 'index'])->name('product-list.index');
Route::get('services-list', [ServiceContronller::class, 'index'])->name('service-list.index');
Route::get('product-detail/{id}', [ProductContronller::class, 'detail'])->name('product-list.detail');
Route::get('product-by-category/{id}', [ProductContronller::class, 'showProductsByCategory'])->name('product-by-category.index');
Route::get('product-wishlist', [Wishlistcontroller::class, 'index'])->name('product-wishlist.index');
Route::post('add-to-wishlist/{id}', [Wishlistcontroller::class, 'addToWishList'])->name('product-wishlist.addToWishList');
Route::get('delete-wishlist/{id}', [Wishlistcontroller::class, 'destroy'])->name('product-wishlist.destroy');

Route::middleware(['auth','verified'])->group(function () {
    Route::post('cart/{id}', [ProductContronller::class, 'addToCart'])->name('cart.add-to-cart');
    Route::get('cart-list', [CartController::class, 'index'])->name('cart-list.index');
    Route::put('cart-update', [CartController::class, 'update'])->name('cart-update');
    Route::get('cart-delete/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('order-product', [ClientOrderController::class, 'index'])->name('order-product.index');
    Route::get('thank-you', [ThanhYouController::class,'thankYou'])->name('order.thank-you');
    Route::get('order-paymentCallback', [ThanhYouController::class, 'paymentCallback'])->name('order.paymentCallback');
    Route::get('purchase-history', [ClientOrderController::class, 'history'])->name('purchase.history');
    Route::get('detail-history/{id}', [ClientOrderController::class, 'detail'])->name('history.detail');
    Route::get('order-cancel/{id}', [ClientOrderController::class, 'cancel'])->name('order.cancel');
    Route::post('feedback-order/{id}', [ClientFeedBackController::class, 'store'])->name('order-feedback.store');
    Route::get('comment-product/{id}', [ClientOrderController::class, 'commentOnProduct'])->name('comment-product.commentOnProduct');
    Route::post('review-product/{productId}', [ProductReviewController::class, 'store'])->name('review-product.store');

    Route::get('location', [NewAddressController::class, 'index'])->name('location.new-add');
    Route::get('address-delete/{id}', [CartController::class, 'delete'])->name('address.delete');
    Route::get('edit-profile/{id}', [ProfileController::class,'edit'])->name('profile.edit');
    Route::put('update-profile/{id}', [ProfileController::class,'update'])->name('profile.update');
    Route::put('update-password/{id}', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    // cong thanh toán
    Route::post('online-checkout', [VnPayController::class, 'onlineCheckout'])->name('order.checkout-online');

    //Review
    Route::get('review', [ProductReviewController::class, 'create'])->name('review.create');
});
Route::middleware(['auth:shipper'])->group(function () {
    Route::get('shipperPage', [HomeController::class, 'shipperPage'])->name('shipper-page');
    Route::get('order-list', [ShipperOrderController::class, 'index'])->name('order-list.index');
    Route::get('edit-order-list/{id}', [ShipperOrderController::class, 'edit'])->name('order-list.edit');
    Route::put('update-order-list/{id}', [ShipperOrderController::class, 'update'])->name('order-list.update');

    //profile shipper

    Route::get('profile-shipper/{id}', [ShipperProfileController::class,'index'])->name('shipper-profile.index');
    Route::put('update-profile-shipper/{id}', [ShipperProfileController::class, 'update'])->name('shipper-profile.update');
    Route::put('update-password-shipper/{id}', [ShipperProfileController::class, 'updatePassword'])->name('shipper-password.update');
});


Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboard', [HomeController::class ,'index'])->name('dashboard');

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
    Route::get('show-order/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::put('update-order/{id}', [OrderController::class,'update'])->name('order.update');
    Route::get('new-order-list', [OrderController::class, 'newOrder'])->name('order-new.index');
    Route::get('success-order-list', [OrderController::class, 'successOrder'])->name('order-success.index');

    Route::get('account', [AccountController::class, 'index'])->name('account.index');
    Route::get('create-account', [AccountController::class, 'create'])->name('account.create');
    Route::post('store-account', [AccountController::class, 'store'])->name('account.store');
    Route::get('edit-account/{id}', [AccountController::class, 'edit'])->name('account.edit');
    Route::put('update-account/{id}', [AccountController::class, 'update'])->name('account.update');

    Route::get('receipt', [ReceiptController::class, 'index'])->name('receipt.index');
    Route::get('create-receipt', [ReceiptController::class, 'create'])->name('receipt.create');
    Route::post('add-product', [ReceiptController::class, 'addProductItemToReceipt'])->name('receipt.add-product-item-to-receipt');
    Route::get('show-receipt', [ReceiptController::class, 'getReceiptProduct'])->name('receipt.get-receipt-product');
    Route::post('add-price-quantity', [ReceiptController::class,'addPriceAndQuantity'])->name('receipt.add-price-and-quantity');
    Route::post('store-receipt', [ReceiptController::class, 'storeReceipt'])->name('receipt.store-receipt');
    Route::get('edit-receipt/{id}', [ReceiptController::class, 'edit'])->name('receipt.edit');
    Route::put('update-receipt/{id}', [ReceiptController::class, 'update'])->name('receipt.update');
    Route::get('detail-receipt/{id}', [ReceiptController::class, 'detail'])->name('receipt.detail');
    Route::get('delete-receipt/{id}', [ReceiptController::class, 'delete'])->name('receipt.delete');

    Route::get('shipper', [ShipperController::class, 'index'])->name('shipper.index');
    Route::get('create-shipper', [ShipperController::class, 'create'])->name('shipper.create');
    Route::post('store-shipper', [ShipperController::class, 'store'])->name('shipper.store');
    Route::get('edit-shipper/{id}', [ShipperController::class, 'edit'])->name('shipper.edit');
    Route::put('update-shipper/{id}', [ShipperController::class, 'update'])->name('shipper.update');
    Route::put('update-password-shipper/{id}', [ShipperController::class, 'updatePassword'])->name('shipper.update-password');

    Route::get('manager-review', [ReviewController::class,'index'])->name('review.index');
    Route::get('edit-review/{id}', [ReviewController::class, 'edit'])->name('review.edit');
    Route::put('update-review/{id}', [ReviewController::class, 'update'])->name('review.update');

    Route::get('manager-feedback', [FeedBackController::class, 'index'])->name('feedback.index');

    //ve bieu do
    Route::get('revenue-chart-only-month', [HomeController::class, 'getChartOnlyMonth'])->name('getChartOnlyMonth.revenue');
    Route::get('filler-revenue-chart-only-month', [HomeController::class, 'filterGetChartOnlyMonth'])->name('filterGetChartOnlyMonth.revenue');
    Route::get('revenue-chart-only-year', [HomeController::class, 'getRevenueByYear'])->name('getRevenueByYear.revenue');
    Route::get('filler-revenue-chart-only-year', [HomeController::class, 'filterGetRevenueByYear'])->name('filterGetRevenueByYear.revenue');
    Route::get('get-order-status-data',[HomeController::class, 'getOrderStatusData'])->name('order.getOrderStatusData');

    Route::get('selling-product-chart', [HomeController::class, 'productChartSale'])->name('productChartOnlyYear.sellingBest');
    Route::get('get-top-customers-chart', [HomeController::class, 'getTopCustomersChart'])->name('user.getTopCustomersChart');
    //profile admin
    Route::get('profile-admin/{id}', [AdminProfileController::class,'index'])->name('admin-profile.index');
    Route::put('update-profile-admin/{id}', [AdminProfileController::class, 'update'])->name('admin-profile.update');
    Route::put('update-password-admin/{id}', [AdminProfileController::class, 'updatePassword'])->name('admin-password.update');

    Route::get('thong-ke', [ThongKeController::class, 'index'])->name('thongke.index');

});
