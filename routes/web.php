<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Craftsmen\CraftsmenController;
use App\Http\Controllers\Craftsmen\CraftsmanJobHistoryController;
use App\Http\Controllers\Home\LandingPageController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\JobRequestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RatingController;

Route::get('/', function () {
    return redirect('/welcome-page');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/craftsmen-details', [AdminController::class, 'viewDetails'])->name('craftsmen.details');
    Route::patch('/craftsmen/{id}/approve', [AdminController::class, 'approveCraftsman'])->name('craftsmen.approve');
    Route::get('/craftsmen/{id}/view', [AdminController::class, 'showCraftsman'])->name('craftsmen.show');
    
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services/store', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
});

Route::get('/craftsmen/register', [CraftsmenController::class, 'craftsRegister'])->name('craftsmen.register');
Route::post('/register-craftsmen', [CraftsmenController::class, 'store'])->name('craftsmen.store');

Route::get('/services/{slug}/craftsmen', [LandingPageController::class, 'viewServiceCraftsmen'])->name('services.craftsmen');

Route::get('/craftsman/{id}/profile', [LandingPageController::class, 'viewCraftsmanProfile'])->name('craftsman.public.profile');

Route::middleware(['auth', 'craftsmen'])->prefix('craftsmen')->group(function () {
    Route::get('/dashboard', [CraftsmenController::class, 'craftsDashboard'])->name('craftsmen.dashboard');
    Route::get('/craftsmen/profile/edit', [CraftsmenController::class, 'editProfile'])->name('craftsmen.profile.edit');
    Route::put('/craftsmen/profile/update', [CraftsmenController::class, 'updateProfile'])->name('craftsmen.profile.update');
    Route::patch('/job-request/{id}/accept', [JobRequestController::class, 'accept'])->name('job.accept');
    Route::patch('/job-request/{id}/reject', [JobRequestController::class, 'reject'])->name('job.reject');
    Route::patch('/jobs/{id}/status', [JobRequestController::class, 'updateStatus'])->name('job.updateStatus');
    Route::post('/craftsman/job-respond/{id}', [CraftsmenController::class, 'respondToJob'])->name('job.respond');
    Route::get('/craftsman/job-history', [CraftsmanJobHistoryController::class, 'index'])->name('craftsman.job_history.index');
});

Route::get('/role/register', [UserController::class, 'index'])->name('role.register');
Route::get('/home', [LandingPageController::class, 'homePage'])->name('home.page');
Route::get('/welcome-page', [WelcomeController::class, 'welcomePage'])->name('welcome.page');
Route::post('/job-request', [JobRequestController::class, 'store'])->name('job.request.store');
Route::post('/payment/process/{jobId}', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::post('/job/{id}/rate', [PaymentController::class, 'rateJob'])->name('job.rate');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';