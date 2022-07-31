<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\EmailVerifyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\SheekController;
use App\Http\Controllers\Super\Bank\StaticBankController;
use App\Http\Controllers\Super\Country\StaticCountriesController;
use App\Http\Controllers\Super\SuperDashboardController;
use App\Http\Controllers\Super\Users\UserController;
use App\Http\Livewire\Counter;
use App\Http\Livewire\EditSheek;
use Illuminate\Support\Facades\Artisan;
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

Route::prefix('auth')->middleware('guest:admin,super')->group(function () {
    Route::get('/{guard}/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);

    // Forget Password
    Route::get('forget-password', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'showForgetPassword'])->name('password.forget');
    Route::post('forget-password', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'sendResetLink']);
    // Reset Password
    Route::get('reset-password/{token}', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetPassword'])->name('password.reset');
    Route::post('reset-password', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'resetPassword']);
});

// Recourses
Route::prefix('check-system')->middleware(['auth:admin', 'banned', 'verified'])->group(function () {
    Route::resource('sheeks', SheekController::class);
    Route::resource('countries', CountryController::class);
    Route::resource('banks', BankController::class);
});

// To Verify Email
Route::prefix('check-system')->middleware(['auth:admin', 'banned'])->group(function () {

    // Email Verification
    Route::get('verify-email', [EmailVerifyController::class, 'showVerifyEmail'])->name('verification.notice');
    Route::get('verify-email/send', [EmailVerifyController::class, 'sendEmailVerification']);
    Route::get('verify/{id}/{hash}', [EmailVerifyController::class, 'emailVerify'])->middleware('signed')->name('verification.verify');
});

Route::prefix('check-system')->middleware(['auth:admin', 'banned', 'verified'])->group(function () {

    // Admin Dashboard
    Route::view('/dashboard', 'back-end.index')->name('back-end.dashboard');
    Route::get('move-sheek/{sheek}', EditSheek::class);

    // Home
    Route::get('dashboard', [SheekController::class, 'statisics'])->name('admin.dashboard');

    // Paid & Recived Sheeks
    Route::get('recived-sheeks', [SheekController::class, 'recivedSheek'])->name('sheeks.recived');
    Route::get('paid-sheeks', [SheekController::class, 'paidSheeks'])->name('sheeks.paid');

    // Change password
    Route::get('change-password', [AuthController::class, 'showChangePassword'])->name('password.change');
    Route::post('change-password', [AuthController::class, 'changePassword']);

    // Show specific banks
    Route::get('show-specific-banks/{country}/country', [BankController::class, 'showSpecificBanks'])->name('banks.specific');

    // Display Country Banks
    Route::get('country-banks/{country}', [CountryController::class, 'displayCountryBanks'])->name('country.banks');
});

Route::prefix('check-system')->middleware(['auth:admin,super', 'verified'])->group(function () {
    // Logout
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('check-system')->group(function () {

    // Register
    Route::get('register', [AuthController::class, 'showRegister'])->name('register.view');
    Route::post('register', [AuthController::class, 'register']);
});

Route::fallback(function () {
    return view('error.page-not-found');
});


Route::get('/foo', function () {
    Artisan::call('route:list');
});

Route::prefix('cheek-system')->middleware('auth:super')->group(function () {
    Route::get('super-dashboard', [SuperDashboardController::class, 'showSuperDashboard'])->name('super.dashboard');

    // Users
    Route::get('show-users', [UserController::class, 'showAllusers'])->name('super.user_show');
    Route::delete('delete-user/{admin}', [UserController::class, 'deleteUser']);
    Route::get('ban-user/{admin}', [UserController::class, 'banAndUnBanUser'])->name('super.user_ban');
    Route::get('admin-follow-up/{admin}', [UserController::class, 'followAdminUserLogs'])->name('super.user_follow_actions');

    // Static Countries
    // Show All
    Route::get('static-countries', [StaticCountriesController::class, 'showAllStaticCountries'])->name('countries.static_show');
    // Create
    Route::get('static-countries-create', [StaticCountriesController::class, 'create'])->name('countries.statis_create');
    Route::post('static-countries-create', [StaticCountriesController::class, 'store'])->name('countries.static_store');
    // Delete
    Route::delete('static-countries/{id}', [StaticCountriesController::class, 'destroy']);

    // Static Banks
    // Create
    Route::get('static-banks-create', [StaticBankController::class, 'create'])->name('banks.static_create');
    Route::post('static-banks-create', [StaticBankController::class, 'store'])->name('banks.static_store');
    // Show
    Route::get('static-banks', [StaticBankController::class, 'index'])->name('banks.static_index');
    // Delete
    Route::delete('static-banks/{id}', [StaticBankController::class, 'delete'])->name('banks.static_delete');
    // Edit
    Route::get('edit-static-bank/{id}', [StaticBankController::class, 'edit'])->name('banks.static_edit');
});
