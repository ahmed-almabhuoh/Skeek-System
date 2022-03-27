<?php

use App\Http\Controllers\SheekController;
use App\Http\Livewire\Counter;
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

Route::prefix('check-system')->group(function () {

    // Admin Dashboard
    Route::view('/', 'back-end.index')->name('back-end.dashboard');
    Route::resource('sheeks', SheekController::class);
});

Route::Livewire('posts', 'post');