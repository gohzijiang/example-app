<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [UserController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', 'AdminController@dashboard');
});

Route::get('admin/insertService', [ServiceController::class, 'create'])->name('services.create');
Route::post('admin/services', [ServiceController::class, 'store'])->name('services.store'); 
Route::get('/service', [ServiceController::class, 'index'])->name('services.index');


Route::get('/bookings/create', [BookingController::class, 'create']);
Route::post('/bookings', [BookingController::class, 'store']);
Route::get('/bookings/{booking}', [BookingController::class, 'show']);
Route::get('/bookings', [BookingController::class, 'index']);




/*
Route::get('admin/insertCategory', [App\Http\Controllers\CategoryController::class, 'insert'])->name('insert.Category');
Route::post('admin/insertCategory/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('add.Category');
Route::get('admin/showCategory', [App\Http\Controllers\CategoryController::class, 'show'])->name('show.Category');
Route::get('admin/deleteCategory/{id}', [App\Http\Controllers\CategoryController::class, 'delete'])->name('delete.Category');
*/
