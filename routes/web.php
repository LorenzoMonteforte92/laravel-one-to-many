<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// //rotta che passa per il middleware di autenticazione
// Route::middleware(['auth', 'verified'])
// //nome rotte inizierà per admin
// ->name('admin.')
// //il prefisso sarà admin/...
// ->prefix('admin')
// //raggruppo tutto 
// ->group(function () {
//     // aggiungo qui le varie rotte di admin tra cui le CRUD
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
// });

Route::middleware(['auth', 'verified'])
->name('admin.')
->prefix('admin')
->group(function() {
    // Le varie rotte di amministrazione
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('projects', ProjectController::class)->parameters([
        'projects' => 'project:slug'
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
