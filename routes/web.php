<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// -=CUSTOM ROUTES=-

Route::get('/events', [EventController::class, 'index'])->name('events.index');


// Only admins and bestuur roles can acces the following pages
Route::middleware(['auth', 'role:admin,bestuur'])->group(function () {
    // Static first
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');

    // Dynamic routes next
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::get('/events/{event}/delete', [EventController::class, 'confirmDelete'])->name('events.confirmDelete');
    Route::delete('/events/delete/{event}', [EventController::class, 'destroy'])->name('events.destroy');
});

Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');


require __DIR__.'/auth.php';
