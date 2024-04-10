<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\BlogController as BlogControllerAdmin;
use App\Http\Controllers\Admin\CategoryController as CategoryControllerAdmin;

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
Route::redirect('/', '/categories');
//Blogs
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{id}', [BlogController::class, 'view'])->name('blogs.view');

//Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'view'])->name('categories.view');
Route::post('categories/search', [CategoryController::class, 'search'])->name('categories.search');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');


Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('blogs', [BlogControllerAdmin::class, 'index'])->name('admin.blogs.index');
    Route::get('blogs/create', [BlogControllerAdmin::class, 'create'])->name('admin.blogs.create');
    Route::post('blogs', [BlogControllerAdmin::class, 'store'])->name('admin.blogs.store');
    Route::get('blogs/{blog}/edit', [BlogControllerAdmin::class, 'edit'])->name('admin.blogs.edit');
    Route::put('blogs/{blog}', [BlogControllerAdmin::class, 'update'])->name('admin.blogs.update');
    Route::delete('blogs/{blog}', [BlogControllerAdmin::class, 'destroy'])->name('admin.blogs.destroy');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('categories', [CategoryControllerAdmin::class, 'index'])->name('admin.categories.index');
    Route::get('categories/create', [CategoryControllerAdmin::class, 'create'])->name('admin.categories.create');
    Route::post('categories', [CategoryControllerAdmin::class, 'store'])->name('admin.categories.store');
    Route::get('categories/{category}/edit', [CategoryControllerAdmin::class, 'edit'])->name('admin.categories.edit');
    Route::put('categories/{category}', [CategoryControllerAdmin::class, 'update'])->name('admin.categories.update');
    Route::delete('categories/{category}', [CategoryControllerAdmin::class, 'destroy'])->name('admin.categories.destroy');
});




