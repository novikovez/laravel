<?php

use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

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
Route::get('dz15/categories/model/{category}', [CategoryController::class, 'showModel']);
Route::get('dz15/books/model', [BookController::class, 'indexModel']);
Route::get('dz15/authors/model', [AuthorController::class, 'indexModel']);

Route::apiResource('/categories', CategoryController::class);



Route::middleware(['auth:api'])->group(
    function() {
        Route::apiResource('/books', BookController::class);
        Route::get('/payment/makePayment/{system}', [PaymentController::class, 'createPayment']);
        Route::post('payment/confirm/{system}', [PaymentController::class, 'confirmPayment']);
    }
);

Route::post('login', [UserController::class, 'login']);





