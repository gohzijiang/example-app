<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarWashingController;
use App\Http\Controllers\PaymentController;
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
Route::post('/bookings', [BookingController::class,'create'])->name('bookings.store');
Route::get('/service', [ServiceController::class, 'index'])->name('services.index');




Route::get('/bookings/create', [BookingController::class, 'create']);
Route::get('/bookings', [BookingController::class, 'index']);
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/booking/details/{booking}', [BookingController::class, 'showDetails'])->name('booking.details');
Route::get('/getAvailableIndustrialLines/{date}', [CarWashingController::class, 'getAvailableIndustrialLines']);
//serachbooking

Route::post('/search/byUserName',[BookingController::class, 'searchByUserName'] )->name('search.ByUserName');
Route::post('/search/byDateTime', [BookingController::class, 'searchByDateTime'])->name('search.ByDateTime');
// routes/web.php


Route::post('/admin/create-business', [CarWashingController::class, 'createBusiness'])->name('createBusiness');
Route::get('/admin/business-form', [CarWashingController::class, 'showBusinessForm'])->name('businessForm');
Route::post('/admin/save-business', [CarWashingController::class, 'saveBusiness'])->name('saveBusiness');

Route::get('/index', [BookingController::class, 'index'])->name('bookings.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/user/index', [BookingController::class, 'userIndex'])->name('user.index');});

    
Route::get('/getOpenCloseTime/{selected_date}', [CarWashingController::class, 'getOpenCloseTime']);
Route::get('/getServiceDuration/{serviceId}', [ServiceController::class, 'getServiceDuration']);



//serach function
Route::get('/getUserIdByName/{name}', [UserController::class, 'getUserIdByName']);


Route::post('/checkout', [BookingController::class, 'paymentPost'])->name('payment.post');
/*
Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');

/*

Route::get('user/booking', [BookingController::class, 'index'])->name('booking');
Route::post('/bookings', [BookingController::class, 'store'])->name('booking.store');



/*
Route::get('admin/insertCategory', [App\Http\Controllers\CategoryController::class, 'insert'])->name('insert.Category');
Route::post('admin/insertCategory/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('add.Category');
Route::get('admin/showCategory', [App\Http\Controllers\CategoryController::class, 'show'])->name('show.Category');
Route::get('admin/deleteCategory/{id}', [App\Http\Controllers\CategoryController::class, 'delete'])->name('delete.Category');
*/
