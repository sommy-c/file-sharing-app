<?php

use App\Http\Controllers\ProfileController;






Route::get('/', [ProfileController::class, 'index'])->name('index');

Route::get('/dashboard', [ProfileController::class, 'showDashboard'])->name('dashboard');


