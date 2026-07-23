<?php

use Illuminate\Support\Facades\Route;

// Controllers - General & Public
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Home\LandingPageController;
use App\Http\Controllers\ProfileController;

// Controllers - Features
use App\Http\Controllers\JobRequestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ChatController;

// Controllers - Craftsmen
use App\Http\Controllers\Craftsmen\CraftsmenController;
use App\Http\Controllers\Craftsmen\CraftsmanJobHistoryController;

// Controllers - Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ServiceController;

/*
|--------------------------------------------------------------------------
| Web Routes - Fundi Digital Platform
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. PUBLIC & LANDING ROUTES
// ==========================================
Route::get('/', function () {
    return redirect()->route('welcome.page');
});

Route::get('/welcome-page', [WelcomeController::class, 'welcomePage'])->name('welcome.page');
Route::get('/home', [LandingPageController::class, 'homePage'])->name('home.page');
Route::get('/about_us', [LandingPageController::class, 'aboutPage'])->name('about.page');
Route::get('/contact_us', [LandingPageController::class, 'contactPage'])->name('contact.page');
Route::get('/services', [LandingPageController::class, 'servicePage'])->name('services.page');
Route::get('/role/register', [UserController::class, 'index'])->name('role.register');

// Public Services & Craftsmen Profile Views
Route::get('/services/{slug}/craftsmen', [LandingPageController::class, 'viewServiceCraftsmen'])->name('services.craftsmen');
Route::get('/craftsman/{id}/profile', [LandingPageController::class, 'viewCraftsmanProfile'])->name('craftsman.public.profile');

// Craftsmen Registration (Public / Guest)
Route::get('/craftsmen/register', [CraftsmenController::class, 'craftsRegister'])->name('craftsmen.register');
Route::post('/register-craftsmen', [CraftsmenController::class, 'store'])->name('craftsmen.store');


// ==========================================
// 2. DASHBOARD ALIAS (Inazuia Errors za Breeze Layout)
// ==========================================
Route::get('/dashboard', function () {
    return redirect()->route('home.page');
})->middleware(['auth'])->name('dashboard');


// ==========================================
// 3. ADMIN PANEL ROUTES (Protected)
// ==========================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard & Craftsmen Approvals
    Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/craftsmen-details', [AdminController::class, 'viewDetails'])->name('craftsmen.details');
    Route::patch('/craftsmen/{id}/approve', [AdminController::class, 'approveCraftsman'])->name('craftsmen.approve');
    Route::get('/craftsmen/{id}/view', [AdminController::class, 'showCraftsman'])->name('craftsmen.show');
    
    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{id}/block', [UserController::class, 'toggleBlock'])->name('users.block');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Services Management
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('/services/store', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
    
    // Comments Management
    Route::get('/comments', [AdminController::class, 'comments'])->name('comments.index');
    Route::delete('/comments/{id}', [AdminController::class, 'destroyComment'])->name('comments.destroy');
});


// ==========================================
// 4. CRAFTSMEN PANEL ROUTES (Protected)
// ==========================================
Route::middleware(['auth', 'craftsmen'])->prefix('craftsmen')->name('craftsmen.')->group(function () {
    Route::get('/dashboard', [CraftsmenController::class, 'craftsDashboard'])->name('dashboard');
    Route::get('/profile/edit', [CraftsmenController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [CraftsmenController::class, 'updateProfile'])->name('profile.update');
    
    // Job Handling
    Route::patch('/job-request/{id}/accept', [JobRequestController::class, 'accept'])->name('job.accept');
    Route::patch('/job-request/{id}/reject', [JobRequestController::class, 'reject'])->name('job.reject');
    Route::patch('/jobs/{id}/status', [JobRequestController::class, 'updateStatus'])->name('job.updateStatus');
    Route::post('/job-respond/{id}', [CraftsmenController::class, 'respondToJob'])->name('job.respond');
    
    Route::get('/job-history', [CraftsmanJobHistoryController::class, 'index'])->name('job_history.index');
});


// ==========================================
// 5. AUTHENTICATED USER ROUTES (Customers / Common Auth)
// ==========================================
Route::middleware(['auth'])->group(function () {
    // Job Requests
    Route::post('/job-request', [JobRequestController::class, 'store'])->name('job.request.store');
    
    // Payments & Ratings
    Route::post('/payment/process/{jobId}', [PaymentController::class, 'processPayment'])->name('payment.process');
    Route::post('/job/{id}/rate', [PaymentController::class, 'rateJob'])->name('job.rate');

    // Live Chat System
    Route::get('/chat/{id}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');

    // Customer Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth scaffolding routes (Breeze/Fortify/etc)
require __DIR__.'/auth.php';