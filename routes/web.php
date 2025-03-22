<?php

use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\MyController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('hello');
});
Route::get('/user/{id?}', function ($id = 1) {
    return "User ID: $id";
})->where('id', '[0-9]+');


//Đặt tên cho đường dẫn
Route::get('/profile123', function () {
    return "User Profile";
})->name('profile');

//Sử dụng controller
Route::get('/my-profile', [MyController::class, 'index']);

//Sử dụng resources
Route::resource('/my-hello', HelloController::class);

//lấy dữ liệu
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

//Route để hiển thị danh sách sản phẩm theo danh mục
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');

//Admin
Route::prefix('admin')->group(function () {
    Route::resource('/products', AdminProductController::class);
});
