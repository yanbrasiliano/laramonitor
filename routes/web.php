<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SiteController;
use App\Http\Controllers\Admin\EndpointController;

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
    Route::get('sites/{uuid}/endpoints', [EndpointController::class, 'index'])->name('admin.endpoints.list');
    Route::post('site/{uuid}/endpoint', [EndpointController::class, 'store'])->name('admin.endpoint.store');
    Route::put('site/{siteUuid}/endpoint/{endpointUuid}', [EndpointController::class, 'update'])->name('admin.endpoint.update');
    Route::delete('site/{siteUuid}/endpoint/{endpointUuid}', [EndpointController::class, 'destroy'])->name('admin.endpoint.destroy');

    Route::get('/endpoints/{endpoint}/logs', [EndpointController::class, 'logs'])->name('admin.endpoint.logs');


    Route::get('/sites', [SiteController::class, 'index'])->name('admin.sites.list');
    Route::post('/site', [SiteController::class, 'store'])->name('admin.site.store');
    Route::put('/site/{uuid}', [SiteController::class, 'update'])->name('admin.site.update');
    Route::delete('/site/{uuid}', [SiteController::class, 'destroy'])->name('admin.site.destroy');
  });


require __DIR__ . '/auth.php';
