<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\SavingController;
use App\Models\Installment;
use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('can:isAdmin')
    ->name('admin.index');

Route::get('/nasabah', [NasabahController::class, 'index'])
    ->middleware('can:isNasabah')
    ->name('nasabah.index');

Route::resource('member', MemberController::class);
Route::resource('saving', SavingController::class);
Route::resource('loan', LoanController::class);
Route::resource('installment', InstallmentController::class);
