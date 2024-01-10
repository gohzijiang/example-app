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
})->name('welcome');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/dashboard', [UserController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', 'AdminController@dashboard');
});

Route::get('admin/insertService', [ServiceController::class, 'create'])->name('services.create');
Route::post('admin/services', [ServiceController::class, 'store'])->name('services.store'); 
Route::post('/bookings', [BookingController::class,'create'])->name('bookings.store');
Route::get('/service', [ServiceController::class, 'index'])->name('services.index');
Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');

Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
Route::get('/bookings', [BookingController::class, 'index']);
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/booking/details/{booking}', [BookingController::class, 'showDetails'])->name('booking.details');
Route::get('/getAvailableIndustrialLines/{date}', [CarWashingController::class, 'getAvailableIndustrialLines']);
//serachbooking

Route::post('/search/byUserName',[BookingController::class, 'searchByUserName'] )->name('search.ByUserName');
Route::post('/search/byDateTime', [BookingController::class, 'searchByDateTime'])->name('search.ByDateTime');
Route::post('/searchByUserNameAndDateTime', [BookingController::class, 'searchByUserNameAndDateTime'])
    ->name('search.ByUserNameAndDateTime');
    //userSearching
    Route::post('/userSearch/byUserName', [BookingController::class, 'userSearchBusinessByDates'])
    ->name('search.userSearchBusinessByDates');
// routes/web.php


Route::post('/admin/create-business', [CarWashingController::class, 'createBusiness'])->name('createBusiness');
Route::get('/admin/business-form', [CarWashingController::class, 'showBusinessForm'])->name('businessForm');
Route::post('/admin/save-business', [CarWashingController::class, 'saveBusiness'])->name('saveBusiness');



Route::get('/index', [BookingController::class, 'index'])->name('bookings.index');
Route::get('BusinessIndex', [CarWashingController::class, 'index'])->name('BusinessIndex');
Route::post('/searchBusinessByMonth', [CarWashingController::class, 'searchBusinessByMonth'])
    ->name('search.BusinessByMonth');

Route::post('/searchBusinessByDates', [CarWashingController::class, 'searchBusinessByDates'])
    ->name('search.BusinessByDates');
    Route::post('/index/all', [BookingController::class, 'indexAll'])->name('bookings.all');


Route::middleware(['auth'])->group(function () {
Route::get('/user/index', [BookingController::class, 'userIndex'])->name('user.index');});
 Route::get('/getOpenCloseTime/{selected_date}', [CarWashingController::class, 'getOpenCloseTime']);
Route::get('/getServiceDuration/{serviceId}', [ServiceController::class, 'getServiceDuration']);



//serach function
Route::get('/getUserIdByName/{name}', [UserController::class, 'getUserIdByName']);
Route::get('/getBookedSlots/{date}', [BookingController::class, 'getBookedSlots']);




Route::post('/checkout', [BookingController::class, 'paymentPost'])->name('payment.post');

Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');


Route::get('user/booking', [BookingController::class, 'index'])->name('booking');
Route::post('/bookings', [BookingController::class, 'store'])->name('booking.store');



