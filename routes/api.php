<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use BookStore\Api\Books\Controllers\BookController;
use BookStore\Api\Auth\Controllers\UserController;
use BookStore\Api\Customers\Controllers\CustomerController;
use BookStore\Api\BookReviews\Controllers\BookReviewController;
use BookStore\Api\OrderDetails\Controllers\OrderDetailController;
use BookStore\Api\Orders\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    // return $request->user();
});

// Route::get('/book', [BookController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
Route::get('/books', [BookController::class, 'index']);
Route::get('/book/{id}', [BookController::class, 'show']);
Route::post('/book', [BookController::class, 'store']);
Route::put('/book/{id}', [BookController::class, 'update']);
Route::delete('/book/{id}', [BookController::class, 'delete']);
Route::post('/books/{id}/upload', [BookController::class, 'upload']);

// Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customer/{id}', [CustomerController::class, 'show']);
Route::post('/customers', [CustomerController::class, 'store']);
Route::put('/customer/{id}', [CustomerController::class, 'update']);
Route::delete('/customer/{id}', [CustomerController::class, 'delete']);

Route::get('/book/reviews', [BookReviewController::class, 'index']);
Route::get('/book/{id}/reviews', [BookReviewController::class, 'show']);
Route::post('/book/reviews', [BookReviewController::class, 'store']);
Route::delete('/book/{id}/reviews', [BookReviewController::class, 'delete']);

Route::get('/orders', [OrderController::class, 'index']);
Route::get('/order/{id}', [OrderController::class, 'show']);
Route::post('/orders', [OrderController::class, 'store']);
Route::put('/order/{id}', [OrderController::class, 'update']);
Route::delete('/order/{id}', [OrderController::class, 'delete']);

Route::get('/orderdetails', [OrderDetailController::class, 'index']);
Route::get('/orderdetail/{id}', [OrderDetailController::class, 'show']);
Route::post('/orderdetail', [OrderDetailController::class, 'store']);
Route::delete('/orderdetail/{id}', [OrderDetailController::class, 'delete']);
});
// Route::post('books', [BookController::class, 'getBooks']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store']);
Route::post('/user/signin', [UserController::class, 'SignIn']);
