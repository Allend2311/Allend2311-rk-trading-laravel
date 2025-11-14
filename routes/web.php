<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;

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

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact.submit');

// Test route for Product::active() method
Route::get('/test-products', function () {
    try {
        $activeProducts = \App\Models\Product::active()->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Product::active() method works!',
            'count' => $activeProducts->count(),
            'products' => $activeProducts->toArray()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'type' => get_class($e)
        ], 500);
    }
})->name('test.products');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [LoginController::class, 'login'])->name('auth.login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('auth.logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('auth.register');
Route::post('/register', [RegisterController::class, 'register'])->name('auth.register.post');
Route::get('/verify', [RegisterController::class, 'showVerificationForm'])->name('auth.verify');
Route::post('/verify', [RegisterController::class, 'verify'])->name('auth.verify.post');

// Protected routes
Route::middleware('auth')->group(function () {
    // Admin routes
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/products', [AdminController::class, 'products'])->name('products');
        Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
        Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
        Route::post('/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.update-status');
    });

    // Customer routes
    Route::prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');
        Route::post('/cart/add', [CustomerController::class, 'addToCart'])->name('cart.add');
        Route::post('/cart/remove', [CustomerController::class, 'removeFromCart'])->name('cart.remove');
        Route::post('/cart/update-quantity', [CustomerController::class, 'updateCartQuantity'])->name('cart.update-quantity');
        Route::post('/checkout', [CustomerController::class, 'checkout'])->name('checkout');
        Route::get('/orders', [CustomerController::class, 'orders'])->name('orders');
        Route::get('/track', [CustomerController::class, 'showTrackForm'])->name('track');
        Route::post('/track', [CustomerController::class, 'trackOrder'])->name('track.post');
    });
});
