<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productController as ProductPage;
use App\Http\Controllers\dashboardController as DashboardPage;
use App\Http\Controllers\indexController as IndexPage;
use App\Http\Controllers\exportController as ExportController;
use App\Http\Controllers\loginController as LoginController;
use App\Http\Controllers\importController as ImportController;
use App\Http\Controllers\AdminController as AdminController;
use App\Http\Controllers\UserController as UserController;
use App\Http\Controllers\ManagernController as ManagerController;
use App\Http\Controllers\PromotionController as PromotionController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/product', [IndexPage::class, 'productsRoot'])->name('pages.product');
// Route::post('/product/add_them', [IndexPage::class, 'store'])->name('product.product');
// Route::delete('/products/delete-selected', [IndexPage::class, 'deleteSelected'])->name('product.delete.selected');
// Route::get('/product/new', [IndexPage::class, 'createpage'])->name('product.create');
// Route::get('/urls', [IndexPage::class, 'urlpage'])->name('pages.urls');
// Route::get('history/{id}', [IndexPage::class, 'historypage'])->name('pages.history');
// Route::get('/home', [IndexPage::class, 'home'])->name('pages.home');
// Route::get('/dashboard', [IndexPage::class, 'dashboardpage'])->name('pages.dashboard');
// Route::get('/categories', [IndexPage::class, 'categoriespage'])->name('pages.categories');
// Route::get('/brand', [IndexPage::class, 'brandpage'])->name('pages.brand');
// Route::get('/setting', [IndexPage::class, 'dashboardPage'])->name('pages.setting');
// Route::get('/export', [ExportController::class, 'export'])->name('export');
// Route::post('/import', [ImportController::class, 'import'])->name('import');

// Auth::routes();

// Route::get('/dashboard', [IndexPage::class, 'dashboardpage'])->middleware('role:admin,manager,user');
Route::get('/', [loginController::class, 'loginview'])->name('loginview');
Route::post('/login', [loginController::class, 'login'])->name('login');
Route::post('/logout', [loginController::class, 'logout'])->name('logout');
Route::get('export', [ExportController::class, 'export'])->name('export');
Route::post('import', [ImportController::class, 'import'])->name('import');
Route::get('reset', [IndexPage::class, 'reset'])->name('reset');
Route::get('history/{id}', [IndexPage::class, 'historypage'])->name('history');
// Route::get('makeChanges', [PromotionController::class, 'promotionForm'])->name('changesform');
Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function () {
    Route::get('dashboard', [AdminController::class, 'dashboardpage_adm'])->name('admin.pages.dashboard');
    Route::get('categories', [IndexPage::class, 'categoriespage'])->name('pages.categories');
    Route::get('brand', [IndexPage::class, 'brandpage'])->name('pages.brand');
    Route::get('setting', [IndexPage::class, 'dashboardPage'])->name('pages.setting');
    Route::get('urls', [IndexPage::class, 'urlpage'])->name('admin.pages.urls');
    Route::get('list_user', [AdminController::class, 'userlist'])->name('pages.user_list');
    Route::get('product', [IndexPage::class, 'productsRoot'])->name('admin.pages.product');
    Route::post('product/add_them', [IndexPage::class, 'store'])->name('admin.product.product');
    Route::delete('products/delete-selected', [IndexPage::class, 'deleteSelected'])->name('product.delete.selected');
    Route::get('product/new', [IndexPage::class, 'createpage'])->name('product.create');
    Route::post('create_promotion', [PromotionController::class, 'createPromotion'])->name('createPromotion');
    Route::get('/changesform/{barcode}/{price}', [PromotionController::class, 'promotionForm'])->name('changesform');
    Route::post('pro_request', [PromotionController::class, 'sendRequest'])->name('send_promotion_request');
});
Route::group(['prefix' => 'manager', 'middleware' => ['role:manager']], function () {
    Route::get('dashboard', [ManagerController::class, 'dashboardpage_manager'])->name('manager.pages.dashboard');
    Route::get('product', [IndexPage::class, 'productsRoot'])->name('manager.pages.product');
    Route::post('product/add_them', [ManagerController::class, 'store'])->name('manager.product.add');
    Route::delete('products/delete-selected', [ManagerController::class, 'deleteSelected'])->name('manager.product.delete.selected');
    Route::get('product/new', [ManagerController::class, 'createpage'])->name('manager.product.create');
    // Route::get('/manager/dashboard', [ManagerController::class, 'index']);
});

Route::group(['prefix' => 'user', 'middleware' => ['role:user']], function () {
    Route::get('dashboard', [UserController::class, 'dashboardpage_user'])->name('user.pages.dashboard');
    Route::get('/product', [IndexPage::class, 'productsRoot'])->name('user.pages.product');
    Route::post('product/add_them', [IndexPage::class, 'store'])->name('user.product.add');
    Route::delete('products/delete-selected', [IndexPage::class, 'deleteSelected'])->name('user.product.delete.selected');
    Route::get('product/new', [IndexPage::class, 'createpage'])->name('user.product.create');
});
