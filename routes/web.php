<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Admin\DashboardComponent;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
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

Route::view('/', 'welcome')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
});

Route::get('password/reset', Email::class)->name('password.request');
Route::get('password/reset/{token}', Reset::class)->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)->middleware('throttle:6,1')->name('verification.notice');
    Route::get('password/confirm', Confirm::class)->name('password.confirm');
});


Route::get('admin', DashboardComponent::class)->name('admin.dashboard');
//setup
Route::get('admin/setup/label', \App\Http\Livewire\Admin\Setup\LabelComponent::class)->name('admin.setup.label');
Route::get('admin/setup/session', \App\Http\Livewire\Admin\Setup\SessionComponent::class)->name('admin.setup.session');
Route::get('admin/setup/group', \App\Http\Livewire\Admin\Setup\GroupComponent::class)->name('admin.setup.group');
Route::get('admin/setup/medium', \App\Http\Livewire\Admin\Setup\MediumComponent::class)->name('admin.setup.medium');
Route::get('admin/setup/shift', \App\Http\Livewire\Admin\Setup\ShiftComponent::class)->name('admin.setup.shift');
Route::get('admin/setup/section', \App\Http\Livewire\Admin\Setup\SectionComponent::class)->name('admin.setup.section');






Route::get('admin/user', \App\Http\Livewire\Admin\UserComponent::class)->name('admin.user');



Route::get('optimize', function () {
    Artisan::call('optimize');
    return "php artisan optimized successfully";
})->name('optimize');
Route::get('migrate', function () {
    Artisan::call('migrate');
    return "php artisan migrate successfully";
})->name('migrate');
Route::get('migrate-fresh', function () {
    Artisan::call('migrate:fresh --seed');
    return "php artisan migrate-fresh successfully";
})->name('migrate.fresh');
Route::get('migrate-rollback', function () {
    Artisan::call('migrate:rollback');
    return "php artisan migrate-rollback successfully";
})->name('migrate.rollback');
Route::get('db-seed', function () {
    Artisan::call('db:seed');
    return "php artisan db:seed successfully";
})->name('db.seed');




Route::middleware('auth')->group(function () {
    Route::get('admin/user', \App\Http\Livewire\Admin\UserComponent::class)->name('admin.user');
    Route::get('/message',\App\Http\Livewire\MessageComponent::class)->name('message');




    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)->middleware('signed')->name('verification.verify');
    Route::post('logout', LogoutController::class)->name('logout');
});



