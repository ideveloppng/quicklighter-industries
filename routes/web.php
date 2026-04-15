<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Reseller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PublicFormController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Public & Shop Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $featuredProducts = Product::with('category')->where('is_featured', true)->where('is_active', true)->latest()->take(3)->get();
    return view('welcome', compact('featuredProducts'));
})->name('home');

Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/support', function () { return view('support'); })->name('support');
Route::get('/reseller', function () {
    $resellers = Reseller::where('is_active', true)->get()->groupBy('state');
    return view('reseller', compact('resellers'));
})->name('reseller');

Route::post('/reseller/apply', [PublicFormController::class, 'storeResellerApplication'])->name('reseller.apply');
Route::post('/support/contact', [PublicFormController::class, 'storeContactMessage'])->name('support.contact');

Route::get('/shop', [ProductController::class, 'index'])->name('shop');
Route::get('/shop/{product:slug}', [ProductController::class, 'show'])->name('shop.show');
Route::get('/track', [TrackingController::class, 'index'])->name('track.index');
Route::get('/track/search', [TrackingController::class, 'track'])->name('track.search');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

/*
|--------------------------------------------------------------------------
| Checkout & Post-Deployment
|--------------------------------------------------------------------------
*/
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/success/{order_number}', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/order/receipt/{order_number}', [CheckoutController::class, 'receipt'])->name('order.receipt');

/*
|--------------------------------------------------------------------------
| User Dashboard
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('user')->group(function () {
    Route::get('/', [UserDashboardController::class, 'index'])->name('user.index');
    Route::get('/orders', [UserDashboardController::class, 'orders'])->name('user.orders');
    Route::get('/orders/{order_number}', [UserDashboardController::class, 'showOrder'])->name('user.orders.show');
});

/*
|--------------------------------------------------------------------------
| Admin Dashboard (HQ)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return auth()->user()->is_admin ? redirect()->route('admin.index') : redirect()->route('user.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users/{user}/toggle-admin', [AdminController::class, 'toggleAdmin'])->name('admin.users.toggle');
    Route::get('/users/{user}/reset-password', [AdminController::class, 'showResetPassword'])->name('admin.users.reset');
    Route::put('/users/{user}/reset-password', [AdminController::class, 'updateUserPassword'])->name('admin.users.updatePassword');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/orders/{order}', [AdminController::class, 'showOrder'])->name('admin.orders.show');
    Route::put('/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.updateStatus');

    Route::get('/payments', [AdminController::class, 'payments'])->name('admin.payments');
    Route::post('/payments/{order}/approve', [AdminController::class, 'approvePayment'])->name('admin.payments.approve');
    Route::post('/payments/{order}/reject', [AdminController::class, 'rejectPayment'])->name('admin.payments.reject');

    Route::get('/products', [ProductController::class, 'adminIndex'])->name('admin.products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    Route::get('/resellers', [AdminController::class, 'resellers'])->name('admin.resellers');
    Route::post('/resellers', [AdminController::class, 'storeReseller'])->name('admin.resellers.store');
    Route::delete('/resellers/{reseller}', [AdminController::class, 'destroyReseller'])->name('admin.resellers.destroy');
    Route::get('/applications', [AdminController::class, 'applications'])->name('admin.applications');
    Route::get('/messages', [AdminController::class, 'messages'])->name('admin.messages');
    Route::delete('/applications/{id}', [AdminController::class, 'destroyApplication'])->name('admin.applications.destroy');
    Route::delete('/messages/{id}', [AdminController::class, 'destroyMessage'])->name('admin.messages.destroy');
});

require __DIR__.'/auth.php';