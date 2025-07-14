<?php

use App\Http\Controllers\HelloController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pzn', function () {
    return "Hello Programmer Zaman Now";
});

// Redirect
Route::redirect('/youtube', '/pzn');

// Fallback for route not found
Route::fallback(function () {
    return "404 by Eza Pratama";
});


// View Route
Route::view('/hello', 'hello', ['name' => 'Ratri']);
Route::get('/hello-again', function () {
    return view('hello', [
        'name' => 'Eza',
    ]);
});

Route::get('/hello-world', function () {
    return view('hello.world', [
        'name' => 'Eza'
    ]);
});

// Route with parameter
Route::get('products/{id}', function ($productId) {
    return "Product $productId";
})->name('product.detail');

Route::get('/products/{product}/items/{item}', function ($productId, $itemId) {
    return "Product $productId, Item $itemId";
})->name('product.item.detail');

// Route with parameter and regular expression
Route::get('/categories/{id}', function ($categoryId) {
    return "Category $categoryId";
})->where('id', '[0-9]+')->name('category.detail');

// Optional Route Parameter
Route::get('/users/{id?}', function (string $userId = '404') {
    return "User : $userId";
})->name('user.detail');

// Route Conflict
Route::get('/conflict/eza', function () {
    return "Conflict Eza Pratama";
});

Route::get('/conflict/{name}', function ($name) {
    return "Conflict $name";
});

Route::get('/produk/{id}', function ($id) {
    $link = route('product.detail', ['id' => $id]);
    return "Link $link";
});

Route::get('/produk-redirect/{id}', function ($id) {
    return redirect()->route('product.detail', ['id' => $id]);
});

// Route Controller
Route::get('/controller/hello/{name}', [HelloController::class, 'hello']);
