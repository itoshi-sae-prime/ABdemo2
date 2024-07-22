<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController as ProductPage;
use App\Http\Controllers\dashboardController as DashboardPage;
use App\Http\Controllers\indexController as IndexPage;
use App\Http\Controllers\DBController as DBPage;
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


// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/test', [ProductPage::class, 'index'])->name('index1');
// Route::get('/', [DBPage::class, 'dbproduct_ab']);
Route::get('/ltk', [IndexPage::class, 'dbproduct_ab']);
// Route::get('/', [IndexPage::class, 'home'])->name('pages.home');
Route::get('/product', [IndexPage::class, 'dbproduct_ab'])->name('pages.product');
Route::get('/product/new', [IndexPage::class, 'createpage'])->name('create');
Route::get('/urls', [IndexPage::class, 'urlpage'])->name('pages.urls');
Route::get('history/{id}', [IndexPage::class, 'historypage'])->name('pages.history');
Route::get('/', [IndexPage::class, 'dashboardPage'])->name('pages.dashboard');
Route::get('/categories', [IndexPage::class, 'dashboardPage'])->name('pages.categories');
Route::get('/brand', [IndexPage::class, 'dashboardPage'])->name('pages.brands');
Route::get('/setting', [IndexPage::class, 'dashboardPage'])->name('pages.setting');
