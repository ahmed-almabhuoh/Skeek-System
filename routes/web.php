<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SheekController;
use App\Http\Livewire\Counter;
use App\Http\Livewire\EditSheek;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('admin', function () {
    redirect()->route('back-end.dashboard');
});

Route::prefix('auth')->middleware('guest:admin')->group(function () {
    Route::get('/{guard}/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

Route::prefix('check-system')->middleware('auth:admin')->group(function () {

    // Admin Dashboard
    Route::view('/', 'back-end.index')->name('back-end.dashboard');
    Route::resource('sheeks', SheekController::class);
    Route::get('move-sheek/{sheek}', EditSheek::class);

    // Logout
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});