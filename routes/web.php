<?php

use App\Http\Controllers\admin\UnCompleteEmailController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\Auth\EmailVerifyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrancyController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SheekController;
use App\Http\Controllers\Super\Bank\StaticBankController;
use App\Http\Controllers\Super\Country\StaticCountriesController;
use App\Http\Controllers\Super\Super\BanAndUnBanSuperController;
use App\Http\Controllers\Super\Super\CreateSuperContorller;
use App\Http\Controllers\Super\Super\DeleteSuperController;
use App\Http\Controllers\Super\Super\EditSuperController;
use App\Http\Controllers\Super\Super\RoleAndPermission\PermissionController;
use App\Http\Controllers\Super\Super\RoleAndPermission\RoleController;
use App\Http\Controllers\Super\Super\Settings\FollowUpSuperController;
use App\Http\Controllers\Super\Super\ShowAllSupersForSuperController;
use App\Http\Controllers\Super\SuperDashboardController;
use App\Http\Controllers\Super\Users\AddNewUserController;
use App\Http\Controllers\Super\Users\UserController;
use App\Http\Controllers\SuperSettingsController;
use App\Http\Livewire\Counter;
use App\Http\Livewire\EditSheek;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf;

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


    // Admin Languages
    Route::get('admin-lang/{lang}', [AdminSettingsController::class, 'changeLanguage'])->name('admins.lang');

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

Route::prefix('cheek-system')->middleware(['auth:super', 'banned'])->group(function () {
    Route::resource('currancies', CurrancyController::class);
    Route::resource('admins', AdminController::class);

    Route::put('update-admin/{id}', [AdminController::class, 'update'])->name('super.admins_update');

    // Roles And Permissions
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
});

Route::prefix('cheek-system')->middleware(['auth:super', 'banned'])->group(function () {
    Route::get('super-dashboard', [SuperDashboardController::class, 'showSuperDashboard'])->name('super.dashboard');

    Route::prefix('reports')->group(function () {
        Route::get('countries-report', [ReportsController::class, 'getCountryReport'])->name('report.countries');
        Route::get('banks.report', [ReportsController::class, 'getAllStaticBanksReport'])->name('report.banks');
        Route::get('currancies.report', [ReportsController::class, 'getAllCurrancyReports'])->name('report.currancies');
    });

    // Users
    Route::get('show-users', [UserController::class, 'showAllusers'])->name('super.user_show');
    Route::delete('delete-user/{admin}', [UserController::class, 'deleteUser']);
    Route::get('ban-user/{admin}', [UserController::class, 'banAndUnBanUser'])->name('super.user_ban');
    Route::get('admin-follow-up/{admin}', [UserController::class, 'followAdminUserLogs'])->name('super.user_follow_actions');
    // -- Add new user
    Route::get('add-user', [AddNewUserController::class, 'showAddNewUser'])->name('super.user_add');
    Route::post('add-user', [AddNewUserController::class, 'storeNewUser'])->name('super.user_store');
    // -- End add new user 

    // Static Countries
    // Show All
    Route::get('static-countries', [StaticCountriesController::class, 'showAllStaticCountries'])->name('countries.static_show');
    // Create
    Route::get('static-countries-create', [StaticCountriesController::class, 'create'])->name('countries.statis_create');
    Route::post('static-countries-create', [StaticCountriesController::class, 'store'])->name('countries.static_store');
    // Edit
    Route::get('statis-country-edit/{id}', [StaticCountriesController::class, 'edit'])->name('country.statis_edit');
    Route::put('statis-country-update/{id}', [StaticCountriesController::class, 'update'])->name('country.statis_update');
    // Delete
    Route::delete('static-countries/{id}', [StaticCountriesController::class, 'destroy']);
    // View 
    Route::get('static-country-view/{id}', [StaticCountriesController::class, 'show'])->name('status_countries.show');

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
    Route::put('edit-static-bank/{id}', [StaticBankController::class, 'update'])->name('banks.static_update');
    // Show
    Route::get('static-bank-view/{id}', [StaticBankController::class, 'show'])->name('static_banks.show');

    // Super Routes
    // -- Create Super
    Route::get('add-super', [CreateSuperContorller::class, 'showCreateSuper'])->name('super.super_create');
    Route::post('add-super', [CreateSuperContorller::class, 'storeSuper'])->name('super.super_store');
    // -- End Create Super
    // -- Index Supers
    Route::get('index-supers', [ShowAllSupersForSuperController::class, 'index'])->name('super.super_index');
    // -- End Index Super
    // -- Edit Super 
    Route::get('edit-super/{super}', [EditSuperController::class, 'showEditSuper'])->name('super.super_edit');
    Route::put('edit-super/{super}', [EditSuperController::class, 'updateSuper'])->name('super.super_update');
    // -- End Edit Super
    // -- Ban And Un-Ban Super
    Route::get('ban-and-un-ban/{id}', [BanAndUnBanSuperController::class, 'banAndUnBanSuper'])->name('super.ban_super');
    // -- End Ban And Un-Ban Super
    // -- Delete Super User
    Route::delete('delete-super/{super}', [DeleteSuperController::class, 'delete']);
    // -- End Delete Super User

    // Role Permission Routes
    Route::get('role-permission/{id}', [RoleController::class, 'showRolePermission'])->name('role.permissions');
    Route::post('role-permission/{id}', [RoleController::class, 'assignPermissionToRole']);

    // Super Languages
    Route::get('super-lang/{lang}', [SuperSettingsController::class, 'changeLanguage'])->name('supers.lang');

    // Follow Up Super User
    Route::get('follow-up-super/{id}', [FollowUpSuperController::class, 'showSuperUserAction'])->name('super.follow_up_actions');
});

Route::get('test', function () {
    $pdf = Pdf::loadView('reports.pdf.invoice');
    return $pdf->download('invoice.pdf');
});


Route::get('un-verifyed-admin', [UnCompleteEmailController::class, 'sendUnVerifyedAdmin']);
Route::get('send-offer', [UnCompleteEmailController::class, 'sendOfferForAdmins']);
