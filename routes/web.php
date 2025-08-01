<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProfileController::class, 'index'])->name('index');

Route::get('index', [ProfileController::class, "index"])->name('index');

Route::get('/dashboard', [ProfileController::class, 'showDashboard'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
    Route::post('/dashbord', [FileController::class, 'upload'])->name('files.upload');
    Route::post('/files/download/{id}', [FileController::class, 'download'])->name('files.download');


    Route::get('/notification', [FileController::class, 'showNotification'])->name('notify');
    Route::get('/inbox/{id}', [FileController::class, 'showInbox'])->name('inbox.show');
    Route::get('/viewfile/{id}', [FileController::class, 'showFile'])->name('files.view');
    Route::get('/outbox', [FileController::class, 'outbox'])->name('messages.outbox');



});



