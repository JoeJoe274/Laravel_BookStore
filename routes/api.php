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
Route::get('/books/{id}', [BookController::class, 'show']);
Route::post('/books', [BookController::class, 'store']);
Route::put('/books/{id}', [BookController::class, 'update']);
Route::delete('/books/{id}', [BookController::class, 'delete']);
Route::post('/books/{id}/upload', [BookController::class, 'upload']);

Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/{id}', [CustomerController::class, 'show']);
Route::post('/customers', [CustomerController::class, 'store']);
Route::put('/customers/{id}', [CustomerController::class, 'update']);
Route::delete('/customers/{id}', [CustomerController::class, 'delete']);

Route::get('/bookreviews', [BookReviewController::class, 'index']);
Route::get('/bookreviews/{id}', [BookReviewController::class, 'show']);
Route::post('/bookreviews', [BookReviewController::class, 'store']);
Route::delete('/bookreviews/{id}', [BookReviewController::class, 'delete']);

Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::post('/orders', [OrderController::class, 'store']);
Route::put('/orders/{id}', [OrderController::class, 'update']);
Route::delete('/orders/{id}', [OrderController::class, 'delete']);

Route::get('/orderdetails', [OrderDetailController::class, 'index']);
Route::get('/orderdetails/{id}', [OrderDetailController::class, 'show']);
Route::post('/orderdetails', [OrderDetailController::class, 'store']);
Route::delete('/orderdetails/{id}', [OrderDetailController::class, 'delete']);
});
// Route::post('books', [BookController::class, 'getBooks']);

Route::get('/user', [UserController::class, 'index']);
Route::get('/user/show/{id}', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store']);
Route::post('/user/signin', [UserController::class, 'SignIn']);
