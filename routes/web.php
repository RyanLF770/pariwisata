<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;


Route::get('/', [UserController::class, 'index'])->name('index');

// Route::get('/dashboard', function () {return redirect('/dashboard');})->middleware('auth');
	Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    // Route::get('/index', [DestinationController::class, 'show'])->name('index');
    Route::get('/home', [DestinationController::class, 'showToindex'])->name('user.index');

Route::group(['middleware' => ['auth','ceklevel:admin,manager,client']], function() {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

    Route::get('/user-add', [HomeController::class, 'userADD'])->name('user.add');
    Route::post('/user-add', [HomeController::class, 'userStore'])->name('user.store');

    Route::get('/destination-add', [DestinationController::class, 'destinationAdd'])->name('destination.add');
    Route::post('/destination-add', [DestinationController::class, 'destinationStore'])->name('destination.store');

    Route::get('/destination/{id}/edit', [DestinationController::class, 'edit'])->name('destination.edit');
    Route::put('/destination/{id}/update', [DestinationController::class, 'update'])->name('destination.update');

    Route::delete('/destination-delete/{id}', [DestinationController::class, 'destinationDelete'])->name('destination.delete');

    Route::get('/user-edit/{id}', [HomeController::class, 'editUser'])->name('user.edit');
    Route::put('/update/{id}', [HomeController::class, 'update'])->name('profile.update');

    Route::delete('/user-delete/{id}', [HomeController::class, 'userDelete'])->name('user.delete');

    Route::get('/user-management', [HomeController::class, 'show'])->name('user.management');
    Route::get('/destination-management', [DestinationController::class, 'show'])->name('destination.management');

    Route::get('/orders', [HomeController::class, 'orders'])->name('admin.orders');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/destination-detail/{id}', [DestinationController::class, 'showDetail'])->name('destination.detail');
    Route::post('/destination-detail/{id}/rating', [DestinationController::class, 'addRating'])->name('destination.addRating');

    Route::get('/destination-booking/{id}/book', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/destination-booking/{id}/book', [BookingController::class, 'store'])->name('booking.store');

    Route::get('/transaction/{id}', [TransactionController::class, 'create'])->name('transaction.create');
    Route::post('/transaction/{id}', [TransactionController::class, 'store'])->name('transaction.store');

    Route::get('/transaction-success/success', [TransactionController::class, 'success'])->name('transaction.success');

	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
});
