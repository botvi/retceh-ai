<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\superadmin\{
    DashboardSuperAdminController,
    ApiWhatsappController,
    ManageTestimoniController,
    ManagePelangganController,
    ProfilController as ProfilSuperAdminController,
    ManageSettingController,
    ManageShowcaseItemController,
    ManagePackageController,
    RiwayatTopupController,
};
use App\Http\Controllers\user\{
    IndexController,
    StudioController,
    GalleryController,
    TopupController,
    ProfilController,
    ReviewController,
};
use App\Http\Controllers\auth\{
    LoginController,
    RegisterController,
    GoogleController,
    ForgotPasswordController,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// QRIS Webhook Route — Tanpa auth middleware (harus bisa diakses server KlikQris)
Route::post('/topup/webhook/qris', [TopupController::class, 'webhookCallback'])->name('topup.webhook');

// Guest / Public Access Routes (Bisa diakses tanpa login)
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/studio', [StudioController::class, 'index'])->name('studio.index');
Route::post('/studio/upload', [StudioController::class, 'upload'])->name('studio.upload');
Route::post('/studio/suggest', [StudioController::class, 'suggest'])->name('studio.suggest');

Route::get('/topup', [TopupController::class, 'index'])->name('topup.index');

// Authentication / Login & Register Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Google OAuth Login
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
Route::get('/auth/google/complete', [GoogleController::class, 'showCompleteForm'])->name('google.complete');
Route::post('/auth/google/complete-register', [GoogleController::class, 'completeRegister'])->name('google.complete.register');

// Forgot Password OTP
Route::get('/forgot-password', [ForgotPasswordController::class, 'showRequestOtpForm'])->name('forgot-password');
Route::get('/forgot-password/verify', [ForgotPasswordController::class, 'showVerifyOtpForm'])->name('forgot-password.verify');
Route::get('/forgot-password/reset', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('forgot-password.reset');
Route::post('/forgot-password/request-otp', [ForgotPasswordController::class, 'requestOtp'])->name('forgot-password.request-otp')->middleware('otp.ratelimit');
Route::post('/forgot-password/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('forgot-password.verify-otp');
Route::post('/forgot-password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('forgot-password.reset-password');


// Logged-in User Protected Routes (middleware = auth)
Route::group(['middleware' => ['auth']], function () {
    // Studio Workspace Actions (Memerlukan Login)
    Route::post('/studio/submit', [StudioController::class, 'submit'])->name('studio.submit');
    Route::get('/studio/status/{taskId}', [StudioController::class, 'status'])->name('studio.status');
    Route::post('/studio/save', [StudioController::class, 'save'])->name('studio.save');

    // Design Gallery
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
    Route::delete('/gallery-clear', [GalleryController::class, 'clear'])->name('gallery.clear');

    // Packages & Top-up Checkout
    Route::get('/topup/checkout/{packageId}', [TopupController::class, 'checkout'])->name('topup.checkout');
    Route::post('/topup/process/{packageId}', [TopupController::class, 'process'])->name('topup.process');
    Route::get('/topup/status/{orderId}', [TopupController::class, 'checkStatus'])->name('topup.check-status');

    // Profile Settings
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::put('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

    // Review Submission
    Route::get('/review', [ReviewController::class, 'index'])->name('review.index');
    Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');
});


// Superadmin Management Dashboard Routes (middleware = role:superadmin)
Route::group(['middleware' => ['role:superadmin']], function () {
    // Dashboard Stats
    Route::get('/dashboard-superadmin', [DashboardSuperAdminController::class, 'index'])->name('dashboard-superadmin');

    // Profil Admin
    Route::get('/profil-superadmin', [ProfilSuperAdminController::class, 'index'])->name('profil-superadmin');
    Route::put('/profil-superadmin/update', [ProfilSuperAdminController::class, 'update'])->name('profil-superadmin.update');

    // API Whatsapp Management
    Route::get('whatsapp-api', [ApiWhatsappController::class, 'index'])->name('whatsapp-api.index');
    Route::post('whatsapp-api', [ApiWhatsappController::class, 'storeorupdate'])->name('whatsapp-api.storeorupdate');

    // Settings Management
    Route::get('manage-settings', [ManageSettingController::class, 'index'])->name('manage-settings.index');
    Route::put('manage-settings/update', [ManageSettingController::class, 'update'])->name('manage-settings.update');

    // Showcase Items CRUD
    Route::resource('showcase', ManageShowcaseItemController::class);

    // Pricing Packages CRUD
    Route::resource('package', ManagePackageController::class);

    // Customers list & Credit Updates
    Route::get('manage-pelanggan', [ManagePelangganController::class, 'index'])->name('manage-pelanggan.index');
    Route::patch('manage-pelanggan/{id}/update-credit', [ManagePelangganController::class, 'updateCredit'])->name('manage-pelanggan.update-credit');
    Route::delete('manage-pelanggan/destroy/{id}', [ManagePelangganController::class, 'destroy'])->name('manage-pelanggan.destroy');

    // Testimonials approval
    Route::get('manage-testimoni', [ManageTestimoniController::class, 'index'])->name('manage-testimoni.index');
    Route::post('manage-testimoni/{id}/toggle', [ManageTestimoniController::class, 'toggleStatus'])->name('manage-testimoni.toggle-status');
    Route::delete('manage-testimoni/destroy/{id}', [ManageTestimoniController::class, 'destroy'])->name('manage-testimoni.destroy');

    // Riwayat Topup
    Route::get('riwayat-topup', [RiwayatTopupController::class, 'index'])->name('riwayat-topup.index');
});