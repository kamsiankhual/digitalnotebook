<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //categories
    Route::resource('/categories',CategoriesController::class);

    // Place this inside your 'auth' middleware group
    Route::get('/dashboards', [DashboardsController::class, 'index'])->name('dashboards.index');

    //notes
    Route::resource('/notes',NotesController::class);

});

require __DIR__.'/auth.php';
