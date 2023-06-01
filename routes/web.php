<?php

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

Route::get('/', App\Http\Controllers\Main\IndexController::class)->name('main.index');

Route::group(['prefix' => 'categories', 'namespace' => 'App\Http\Controllers\Category'], function () {
    Route::get('/', IndexController::class)->name('category.index');
    Route::get('/create', CreateController::class)->name('category.create');
    Route::post('/', StoreController::class)->name('category.store');
    Route::get('/{category}/edit', EditController::class)->name('category.edit');
    Route::get('/{category}', ShowController::class)->name('category.show');
    Route::patch('/{category}', UpdateController::class)->name('category.update');
    Route::delete('/{category}', DeleteController::class)->name('category.delete');
});

Route::group(['prefix' => 'tags', 'namespace' => 'App\Http\Controllers\Tag'], function () {
    Route::get('/', IndexController::class)->name('tag.index');
    Route::get('/create', CreateController::class)->name('tag.create');
    Route::post('/', StoreController::class)->name('tag.store');
    Route::get('/{tag}/edit', EditController::class)->name('tag.edit');
    Route::get('/{tag}', ShowController::class)->name('tag.show');
    Route::patch('/{tag}', UpdateController::class)->name('tag.update');
    Route::delete('/{tag}', DeleteController::class)->name('tag.delete');
});

Route::group(['prefix' => 'colors', 'namespace' => 'App\Http\Controllers\Color'], function () {
    Route::get('/', IndexController::class)->name('color.index');
    Route::get('/create', CreateController::class)->name('color.create');
    Route::post('/', StoreController::class)->name('color.store');
    Route::get('/{color}/edit', EditController::class)->name('color.edit');
    Route::get('/{color}', ShowController::class)->name('color.show');
    Route::patch('/{color}', UpdateController::class)->name('color.update');
    Route::delete('/{color}', DeleteController::class)->name('color.delete');
});

Route::group(['prefix' => 'users', 'namespace' => 'App\Http\Controllers\User'], function () {
    Route::get('/', IndexController::class)->name('user.index');
    Route::get('/create', CreateController::class)->name('user.create');
    Route::post('/', StoreController::class)->name('user.store');
    Route::get('/{user}/edit', EditController::class)->name('user.edit');
    Route::get('/{user}', ShowController::class)->name('user.show');
    Route::patch('/{user}', UpdateController::class)->name('user.update');
    Route::delete('/{user}', DeleteController::class)->name('user.delete');
});

Route::group(['prefix' => 'products', 'namespace' => 'App\Http\Controllers\Product'], function () {
    Route::get('/', IndexController::class)->name('product.index');
    Route::get('/create', CreateController::class)->name('product.create');
    Route::post('/', StoreController::class)->name('product.store');
    Route::get('/{product}/edit', EditController::class)->name('product.edit');
    Route::get('/{product}', ShowController::class)->name('product.show');
    Route::patch('/{product}', UpdateController::class)->name('product.update');
    Route::delete('/{product}', DeleteController::class)->name('product.delete');
});


// Route::get('/', function () {
//     return view('welcome');
// });
