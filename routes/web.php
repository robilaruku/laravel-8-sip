<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use GuzzleHttp\Middleware;
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
    return redirect()->route('login');
});

Route::get('login', [LoginController::class, 'index'])->name('login');

Route::post('login/process', [LoginController::class, 'authenticate'])->name('process');

Route::group([Middleware::class, 'auth'], function () {

    Route::get('admin', [DashboardController::class, 'index'])->name('admin');

    Route::get('admin/categories/index', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('admin/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('admin/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('admin/categories/{id}/show', [CategoryController::class,'show'])->name('categories.show');
    Route::get('admin/categories/{id}/edit', [CategoryControlle::class, 'edit'])->name('categories.edit');
    Route::put('admin/categories/{id}/update', [CategoryController::class,'update'])->name('categories.update');
    Route::delete('admin/categories/{id}/destroy', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::resource('admin/products', ProductController::class);

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('admin/transactions/create', [TransactionController::class,'create'])->name('transactions.create');
    Route::post('admin/transactions/import', [TransactionController::class,'import'])->name('transactions.import');
    Route::get('admin/transactions/index', [TransactionController::class, 'index'])->name('transactions.index');

});
