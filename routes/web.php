<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Pest\Plugins\Profile;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', [ProfileController::class, 'showDashboard'])->name('dashboard');

