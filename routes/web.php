<?php

use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\ResponseController;
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

// Request
Route::get('/controller/hello/request', [HelloController::class, 'request']);
// Route Controller
Route::get('/controller/hello/{name}', [HelloController::class, 'hello']);

// Request Input
Route::get('/input/hello', [InputController::class, 'hello']);
Route::post('/input/hello', [InputController::class, 'hello']);
Route::post('/input/hello/first', [InputController::class, 'helloFirstName']);
Route::post('/input/hello/input', [InputController::class, 'helloInput']);
Route::post('/input/hello/array', [InputController::class, 'helloArray']);

// Requst Input Type
Route::post('input/type', [InputController::class, 'inputType']);

// Route Filter Input
Route::post('/input/filter/only', [InputController::class, 'filterOnly']);
Route::post('/input/filter/except', [InputController::class, 'filterExcept']);
Route::post('/input/filter/merge', [InputController::class, 'filterMerge']);

// Route File Upload
Route::post('/file/upload', [FileController::class, 'upload']);

// Response Route
Route::get('/response/hello', [ResponseController::class, 'response']);
Route::get('/response/header', [ResponseController::class, 'header']);

Route::get('/response/type/view', [ResponseController::class, 'responseView']);
Route::get('/response/type/json', [ResponseController::class, 'responseJson']);
Route::get('/response/type/file', [ResponseController::class, 'responseFile']);
Route::get('/response/type/download', [ResponseController::class, 'responseDownload']);


// Cookie
Route::get('/cookie/set', [CookieController::class, 'createCookie']);
Route::get('/cookie/get', [CookieController::class, 'getCookie']);
Route::get('/cookie/clear', [CookieController::class, 'clearCookie']);