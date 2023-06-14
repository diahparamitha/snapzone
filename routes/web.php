<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HeroController;

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

//Landing atau Tampilan Pengguna
Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/product', [LandingController::class, 'product']);
Route::get('/product/detail/{id}', [LandingController::class, 'productDetail'])->middleware('checkLogin');
Route::get('/product/categories/{slug}', [LandingController::class, 'productByCategory']);
Route::get('/search', [LandingController::class, 'search'])->name('product.search');
Route::get('/user/detail/{id}', [LandingController::class, 'detailUser']);
Route::get('/user/update/{id}', [LandingController::class, 'updateUser']);
Route::post('/user/update/{id}', [LandingController::class, 'updateUser1']);

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'loginAkun'])->name('login');
Route::post('/logout', [AuthController::class, 'logout']);

//Dashboard Admin bagian Users
Route::get('/admin/index', [UserController::class, 'index']);
Route::get('/admin/users/index', [UserController::class, 'tabel_user']);
Route::get('/admin/users/role/{role}', [UserController::class, 'userByRole']);
Route::get('/admin/users/create', [UserController::class, 'create']);
Route::post('/admin/users/create', [UserController::class, 'createUser']);
Route::get('/admin/users/detail/{id}', [UserController::class, 'detail']);
Route::get('/admin/users/update/{id}', [UserController::class, 'update']);
Route::post('/admin/users/update/{id}', [UserController::class, 'updateUser']);
Route::post('/admin/users/delete/{id}', [UserController::class, 'delete']);

//Dashboard Admin bagian categories
Route::get('/admin/category-list', [CategoryController::class, 'categoryList']);
Route::get('/admin/category/create', [CategoryController::class, 'create']);
Route::post('/admin/category/create', [CategoryController::class, 'createCategory']);
Route::get('/admin/category/detail/{id}', [CategoryController::class, 'detail']);
Route::get('/admin/category/update/{id}', [CategoryController::class, 'update']);
Route::post('/admin/category/update/{id}', [CategoryController::class, 'updateCategory']);
Route::get('/admin/category/detail/{id}', [CategoryController::class, 'detail']);
Route::post('/admin/category/delete/{id}', [CategoryController::class, 'delete']);


//Dashboard Admin bagian products
Route::get('/admin/product-list', [ProductController::class, 'productList']);
Route::get('/admin/product-list/category/{slug}', [ProductController::class, 'productListByCategory']);
Route::get('/admin/product/create', [ProductController::class, 'create']);
Route::post('/admin/product/create', [ProductController::class, 'createProduct']);
Route::get('/admin/detail-product/{id}', [ProductController::class, 'detail']);
Route::get('/admin/update-product/{id}', [ProductController::class, 'update']);
Route::post('/admin/update-product/{id}', [ProductController::class, 'updateProduct']);
Route::post('/admin/delete-product/{id}', [ProductController::class, 'delete']);
Route::get('/update-product-status/{id}/{status}', [ProductController::class, 'updateStatus']);

//Dashboard admin bagian heroes
Route::get('/admin/hero-list', [HeroController::class, 'heroList']);
Route::get('/admin/hero/create', [HeroController::class, 'create']);
Route::post('/admin/hero/create', [HeroController::class, 'createHero']);
Route::post('/admin/update-status/{heroId}', [HeroController::class, 'updateStatus'])->name('admin.update-status');
Route::post('/admin/update-disetujui/{heroId}', [HeroController::class, 'updateDisetujui'])->name('admin.update-disetujui');
Route::get('/admin/hero/update/{id}', [HeroController::class, 'update']);
Route::post('/admin/hero/update/{id}', [HeroController::class, 'updateHero']);
Route::post('/admin/delete-hero/{id}', [HeroController::class, 'delete']);
