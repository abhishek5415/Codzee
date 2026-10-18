<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;

//Admin
// Route::middleware(['auth', 'isAdmin'])->group(function () {
Route::group(['middleware' => ['isAdmin']], function () {
    Route::get('/admin',[AdminController::class,'index']);
    Route::get('/logout',[AdminController::class,'logout']);
    Route::get('admin/products',[AdminController::class,'adminProducts']);
    Route::post('admin/addProduct',[AdminController::class,'addProducts']);
    Route::post('admin/updateProduct',[AdminController::class,'updateProducts']);
    Route::get('admin/deleteProduct/{id}',[AdminController::class,'deleteProducts']);
    Route::get('admin/customers',[AdminController::class,'adminCustomers']);
    Route::get('admin/changeUserStatus/{status}/{id}',[AdminController::class,'changeUserStatus']);
    Route::post('admin/addCustomer',[AdminController::class,'addCustomer']);
    Route::get('admin/profile',[AdminController::class,'profile']);
    Route::post('admin/updateProfile',[AdminController::class,'updateProfile']);
    Route::get('admin/orders',[AdminController::class,'adminOrders']);
    Route::get('admin/changeOrderStatus/{status}/{id}',[AdminController::class,'changeOrderStatus']);
});

// Customer
Route::get('/register',[CustomerController::class,'registerView']);
Route::post('/register',[CustomerController::class,'register']);
Route::get('/login',[CustomerController::class,'loginView']);
Route::post('/login',[CustomerController::class,'login']);
Route::get('/logout',[CustomerController::class,'logout']);
Route::get('/profile',[CustomerController::class,'profile']);
Route::post('/updateProfile',[CustomerController::class,'updateProfile']);

// Product
Route::get('/',[ProductController::class,'index']);
Route::get('/productview/{id}',[ProductController::class,'productView']);
Route::post('/addToCart',[ProductController::class,'addToCart']);
Route::get('/cart',[ProductController::class,'cart']);
Route::post('/updateCartItem/{id}',[ProductController::class,'updateCartItem']);
Route::get('/deleteCartItem/{id}',[ProductController::class,'deleteCartItem']);
Route::post('/checkout',[ProductController::class,'checkout']);
Route::get('/myorders',[ProductController::class,'myorders']);
Route::get('/shop',[ProductController::class,'shop']);
Route::get('/wishlist',[ProductController::class,'wishlist']);
Route::get('addToWishlist/{id}',[ProductController::class,'addToWishlist']);
Route::get('/deleteWishlistItem/{id}',[ProductController::class,'deleteWishlistItem']);
