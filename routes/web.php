<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Pest\Plugins\Profile;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/dashboard', [ProfileController::class, 'showDashboard'])->name('dashboard');

