<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\SupportController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('public.page', ['slug' => 'demo-creator']);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/page', [PageController::class, 'edit'])->name('page.edit');
    Route::patch('/page', [PageController::class, 'update'])->name('page.update');

    Route::post('/links', [\App\Http\Controllers\LinkController::class, 'store'])->name('links.store');
    Route::patch('/links/{link}', [\App\Http\Controllers\LinkController::class, 'update'])->name('links.update');
    Route::delete('/links/{link}', [\App\Http\Controllers\LinkController::class, 'destroy'])->name('links.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/supports', [SupportController::class, 'store'])->name('supports.store');
Route::get('/@{slug}', [PublicPageController::class, 'show'])->name('public.page');
 
require __DIR__.'/auth.php';

