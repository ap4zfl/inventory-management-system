<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserRegisterController;
use App\Http\Controllers\userController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);


Route::get('/registration', function () {
    if (session('user_id')) {
        return redirect('/');
    }
    return view('registration');
});
Route::get('/login', function () {
    if (session('user_id')) {
        return redirect('/');
    }
    return view('login');
});

Route::post('/register', [UserRegisterController::class, 'store'])->name('user_register.store');
Route::post('/login', [UserRegisterController::class, 'login'])->name('user_register.login');
Route::get('/logout', [UserRegisterController::class, 'logout'])->name('user_register.logout');

Route::get('/logout', function () {
    if (session()->has('user_id')) {
        session()->flush();
    }
    return redirect('/');
});

// Admin routes
Route::group(['middleware' => ['adminrestrictions']], function () {

// Route::view('admin-dashboard','admin.dashboard');
Route::get('/admin-dashboard', [dashboardController::class, 'admindashboard'])->name('admin.dashboard');
Route::view('view-users','admin.view-users');
Route::get('/view-userajax', [userController::class, 'view_users']);
Route::post('/update-user-status', [UserController::class, 'updateStatus']);
Route::post('/edit-user', [UserController::class, 'editUser']);
Route::post('/delete-user', [UserController::class, 'deleteUser']);
Route::post('/update-user-role', [UserController::class, 'updateUserRole']);
// Route::view('all-product','admin.all-product');
Route::get('/all-product', [ProductController::class, 'viewadminproducts']);
Route::get('/view-products-admin', [ProductController::class, 'viewProducts']);
Route::get('/view-product-comment/{id}', [ProductController::class, 'viewProductComment']);
Route::get('/orders', [OrderController::class, 'viewOrders'])->name('orders');
Route::get('/order/{id}', [OrderController::class, 'viewOrderDetails'])->name('order.details');

});

// Adviser Routes
Route::group(['middleware' => ['adviserrestrictons']], function () {
    // Route::view('adviser-dashboard','adviser.dashboard');
    Route::get('/adviser-dashboard', [dashboardController::class, 'adviserdashboard'])->name('adviser.dashboard');
    Route::view('product','adviser.product');
    Route::get('/view-products-adviser', [ProductController::class, 'viewProducts']);
    Route::post('/update-stack-comment', [ProductController::class, 'updateStackComment']);
    Route::post('/add-to-cart', [ProductController::class, 'addToCart']);
    Route::view('/checkout-cart', 'adviser.checkout');
    Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout');
    Route::post('/remove-from-cart', [ProductController::class, 'removeFromCart']);
    Route::post('/place-order', [OrderController::class, 'placeOrder']);

});


// frontend cart 
Route::post('/add-to-cart-front', [HomeController::class, 'addToCart'])->name('addToCart');
Route::get('/get-cart', [HomeController::class, 'getCart'])->name('getCart');
Route::view('/checkout-cart-data', 'checkout-cart');
Route::get('/checkout-front', [HomeController::class, 'checkout'])->name('checkout');
Route::post('/remove-from-cart-front', [HomeController::class, 'removeFromCart']);
Route::post('/place-order-front', [OrderController::class, 'placeOrderfront']);








