<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SortitionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
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


Route::get('/', [AdminController::class, 'dashboard'])->name('admin.index');
Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
Route::get('/forms', [AdminController::class, 'forms'])->name('admin.forms');
Route::get('/buttons', [AdminController::class, 'buttons'])->name('admin.buttons');
Route::get('/cards', [AdminController::class, 'cards'])->name('admin.cards');
// Route::get('/charts', [AdminController::class, 'charts'])->name('admin.charts');
Route::get('/modals', [AdminController::class, 'modals'])->name('admin.modals');
Route::get('/tables', [AdminController::class, 'tables'])->name('admin.tables');

Route::get('/errors', [AdminController::class, 'errors'])->name('admin.pages.errors');
Route::get('/blank', [AdminController::class, 'blank'])->name('admin.pages.blank');

Route::get('/createAccount', [AdminController::class, 'createAccount'])->name('admin.pages.createAccount');
Route::get('/forget', [AdminController::class, 'forget'])->name('admin.pages.forget');
Route::get('/auth/login', [AdminController::class, 'login'])->name('admin.pages.login');

/**==============> route auth */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::get('users/pdf', [UserController::class, 'pdf'])->name('pdf');
Route::get('users/excel', [UserController::class, 'excel'])->name('excel');




Route::middleware('auth')->group(function () {
    Route::resource('gallerys', ProductController::class);
  
});

require __DIR__.'/auth.php';
