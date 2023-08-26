<?php

use App\Http\Controllers\Author\AuthorController;
use App\Http\Controllers\Book\BookController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\User\UserController;
use App\Http\Middleware\UserRouteMiddleware;
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
Route::get('dz15/categories/model', [CategoryController::class, 'showModel']);
Route::get('dz15/books/model', [BookController::class, 'indexModel']);
Route::get('dz15/authors/model', [AuthorController::class, 'indexModel']);

Route::get('dz15/categories/iterator', [CategoryController::class, 'showIterator']);
Route::get('dz15/books/iterator', [BookController::class, 'showIterator']);
Route::get('dz15/authors/iterator', [AuthorController::class, 'showIterator']);

Route::middleware(['auth:api'])->group(
    function() {
        Route::get('dz15/books/iterator', [BookController::class, 'showIterator'])
            ->middleware(UserRouteMiddleware::class);
        Route::get('dz15/authors/iterator', [AuthorController::class, 'showIterator'])
            ->middleware(UserRouteMiddleware::class);

        Route::apiResource('/books', BookController::class);
        Route::get('/payment/makePayment/{system}', [PaymentController::class, 'createPayment']);
        Route::post('payment/confirm/{system}', [PaymentController::class, 'confirmPayment']);
    }
);

Route::post('login', [UserController::class, 'login']);





