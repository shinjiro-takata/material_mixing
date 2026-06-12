<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaterialController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WeighingLogController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\LogoutController;

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

// ログアウト
Route::post('/logout', [LogoutController::class, 'destroy'])->name('logout')->middleware('auth');

// ログイン（auth）していて、かつ管理者（can:admin-only）であること
Route::middleware(['auth', 'can:admin-only'])->group(function () {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::resource('users', UserManagementController::class)->except(['show']);

    // 材料管理
    Route::resource('materials', MaterialController::class)->except(['show']);

    // 管理者のみレシピを管理（作成・編集・削除）
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
    Route::put('/recipes/{recipe}', [RecipeController::class, 'update'])->name('recipes.update');
    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');
});

// ログイン（auth）している人だけがアクセスできるように上書き
Route::middleware(['auth'])->group(function () {
    Route::get('/index', [DashboardController::class, 'index'])->name('index');
    Route::get('/logs/export', [WeighingLogController::class, 'export'])->name('logs.export');
    Route::resource('logs', WeighingLogController::class);

    // すべての認証ユーザーがレシピ確認のみ可能
    Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
    Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
});
