<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SiteController;

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
});

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')
  ->prefix('admin')
  ->group(function () {
    Route::get('/sites', [SiteController::class, 'index'])->name('admin.sites.list');
    Route::post('/sites', [SiteController::class, 'store'])->name('admin.sites.store');
    Route::get('/sites/{site}', [SiteController::class, 'show'])->name('admin.sites.show');
    Route::get('/sites/{site}/edit', [SiteController::class, 'edit'])->name('admin.sites.edit');
    Route::put('/sites/{site}', [SiteController::class, 'update'])->name('admin.sites.update');
    Route::delete('/sites/{site}', [SiteController::class, 'destroy'])->name('admin.sites.destroy');
  });


require __DIR__ . '/auth.php';
