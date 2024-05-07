<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\QuestionareController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClusteringController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DigitalWardrobeController;
use App\Http\Controllers\MixMatchController;
use App\Http\Controllers\OutfitHistoryController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Question\Question;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login-post', 'authenticate')->name('login_post');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'index')->name('register');
    Route::post('/register-post', 'register')->name('register_post');
});
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::controller(PasswordController::class)->group(function () {
    Route::get('/forgot-password', 'forgotPassword')->name('forgot-password');
    Route::post('/forgot-passwordpost', 'forgotPasswordPost')->name('forgot-password-post');

    Route::get('validasi-forgot-password/{token}', 'validasiForgotPassword')->name('validasi-forgot-password');
    Route::post('validasi-forgot-password-post', 'validasiForgotPasswordPost')->name('validasi-forgot-password-post');
    // Route::get('/reset-password/{token}', 'resetPassword')->name('reset-password');
    // Route::post('/reset-password-post', 'resetPasswordPost')->name('reset-password-post');
});

Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::controller(QuestionareController::class)->group(function () {
        Route::get('/questionare', 'index')->name('questionare');
        Route::put('/questionareUpdate', 'update')->name('questionareUpdate');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/manage-account', 'manage_account')->name('manage_account');
        Route::post('/auth/update-profile', 'updateProfile')->name('update-profile');
        Route::post('/auth/update-password', 'updatePassword')->name('update-password');
    });
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::prefix('digital-wardrobe')->group(function () {
        Route::get('/', [DigitalWardrobeController::class, 'index'])->name('digital-wardrobe');
        Route::get('/filter', [DigitalWardrobeController::class, 'filter'])->name('digital-wardrobe.filter');
        Route::post('/store', [DigitalWardrobeController::class, 'store'])->name('digital-wardrobe.store');
        Route::get('/edit-data/{id}', [DigitalWardrobeController::class, 'editData'])->name('digital-wardrobe.edit-data');
        Route::post('/update-data', [DigitalWardrobeController::class, 'updateData'])->name('digital-wardrobe.update-data');
        Route::post('/delete-data', [DigitalWardrobeController::class, 'deleteData'])->name('digital-wardrobe.delete-data');
    });
    Route::get('/outfit-history', [OutfitHistoryController::class, 'index'])->name('outfit-history');
    Route::get('/outfit-history/filter', [OutfitHistoryController::class, 'filter'])->name('outfit-history.filter');
    Route::post('/outfit-history/update', [OutfitHistoryController::class, 'updateData'])->name('outfit-history.update');
    Route::get('/outfit-history/get-data/{id}', [OutfitHistoryController::class, 'getData'])->name('outfit-history.get-data');
    Route::get('/outfit-history/edit-data', [OutfitHistoryController::class, 'editData'])->name('outfit-history.edit-data');
    Route::post('/outfit-history/delete-data', [OutfitHistoryController::class, 'deleteData'])->name('outfit-history.delete-data');
    Route::prefix('mix-match')->group(function () {
        Route::get('/', [MixMatchController::class, 'index'])->name('mix-match');

        Route::get('/auto-mix-match', [MixMatchController::class, 'index_auto'])->name('auto-mix-match');
        Route::post('/store', [MixMatchController::class, 'store'])->name('mix-match.store');
        Route::post('/generate-auto-mix-match', [MixMatchController::class, 'generateAutoMixMatch'])->name('mix-match.generate-auto-mix-match');
    });
});


// Route::get("/generate", [ClusteringController::class, 'ClusteringData']);
