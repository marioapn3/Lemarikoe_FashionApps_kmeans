<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClusteringController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DigitalWardrobeController;
use App\Http\Controllers\MixMatchController;
use App\Http\Controllers\OutfitHistoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});


Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'loginView')->name('login');
    Route::get('/register', 'registerView')->name('register');
    Route::post('/login-post', 'authenticate')->name('login_post');
    Route::post('/register-post', 'register')->name('register_post');
    Route::get('/logout', 'logout')->name('logout');
});

// Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {
//     Route::get('/manage-account', [AuthController::class, 'manage_account'])->name('manage_account');
//     Route::get('/', [DashboardController::class, 'index'])->name('index');
//     Route::controller(DigitalWardrobeController::class)->group(function () {
//         Route::get('/digital-wardrobe', 'index')->name('digital-wardrobe');
//         Route::post('/digital-wardrobe/post', 'store')->name('digital-wardrobe.store');
//     });
//     Route::controller(OutfitHistoryController::class)->group(function () {
//         Route::get('/outfit-history', 'index')->name('outfit-history');
//     });

//     Route::controller(MixMatchController::class)->group(function () {
//         Route::get('/mix-match', 'index')->name('mix-match');
//         Route::get('/auto-mix-match', 'index_auto')->name('auto-mix-match');
//     });
// });

Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/questionare', [AuthController::class, 'questionare'])->name('questionare');
    Route::put('/questionareUpdate', [AuthController::class, 'questionareUpdate'])->name('questionareUpdate');
    Route::get('/manage-account', [AuthController::class, 'manage_account'])->name('manage_account');
    Route::post('/auth/update-profile', [AuthController::class, 'updateProfile'])->name('update-profile');
    Route::post('/auth/update-password', [AuthController::class, 'updatePassword'])->name('update-password');
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::prefix('digital-wardrobe')->group(function () {
        Route::get('/', [DigitalWardrobeController::class, 'index'])->name('digital-wardrobe');
        Route::post('/store', [DigitalWardrobeController::class, 'store'])->name('digital-wardrobe.store');
        Route::get('/edit-data/{id}', [DigitalWardrobeController::class, 'editData'])->name('digital-wardrobe.edit-data');
        Route::post('/update-data', [DigitalWardrobeController::class, 'updateData'])->name('digital-wardrobe.update-data');
        Route::post('/delete-data', [DigitalWardrobeController::class, 'deleteData'])->name('digital-wardrobe.delete-data');
    });
    Route::get('/outfit-history', [OutfitHistoryController::class, 'index'])->name('outfit-history');
    Route::get('/outfit-history/get-data/{id}', [OutfitHistoryController::class, 'getData'])->name('outfit-history.get-data');
    Route::post('/outfit-history/delete-data', [OutfitHistoryController::class, 'deleteData'])->name('outfit-history.delete-data');
    Route::prefix('mix-match')->group(function () {
        Route::get('/', [MixMatchController::class, 'index'])->name('mix-match');
        Route::get('/auto-mix-match', [MixMatchController::class, 'index_auto'])->name('auto-mix-match');
        Route::post('/store', [MixMatchController::class, 'store'])->name('mix-match.store');
        Route::post('/generate-auto-mix-match', [MixMatchController::class, 'generateAutoMixMatch'])->name('mix-match.generate-auto-mix-match');
    });
});


// Route::get("/generate", [ClusteringController::class, 'ClusteringData']);
