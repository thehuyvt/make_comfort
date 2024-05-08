<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'categories', 'as'=>'categories.'], function (){
    Route::get('', [CategoryController::class, 'index'])->name('index');
    Route::get('create', [CategoryController::class, 'create'])->name('create');
    Route::post('store', [CategoryController::class, 'store'])->name('store');
    Route::get('edit/{categoryId}', [CategoryController::class, 'edit'])->name('edit');
    Route::put('update/{categoryId}', [CategoryController::class, 'update'])->name('update');
});

Route::group(['prefix' => 'products', 'as'=>'products.'], function (){
    Route::get('', [ProductController::class, 'index'])->name('index');
    Route::get('create', [ProductController::class, 'create'])->name('create');
    Route::post('store', [ProductController::class, 'store'])->name('store');
    Route::get('edit/{productId}', [ProductController::class, 'edit'])->name('edit');
    Route::put('update/{productId}', [ProductController::class, 'update'])->name('update');
});
