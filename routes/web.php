<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EventTypeController;
use App\Http\Controllers\CalendarController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', App\Livewire\Dashboard::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Transactions - Livewire
    Route::get('/transactions', App\Livewire\Transactions\Index::class)->name('transactions.index');
    
    // Events - Hybrid (Index=Livewire, Create/Edit/Show=Controller)
    Route::get('/events', App\Livewire\Events\Index::class)->name('events.index');
    Route::get('/events/create', App\Livewire\Events\CreateEdit::class)->name('events.create');
    Route::get('/events/{event}/edit', App\Livewire\Events\CreateEdit::class)->name('events.edit');
    // Route::post('/events', [EventController::class, 'store'])->name('events.store'); // Removed
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
    // Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update'); // Removed
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::patch('/events/{event}/confirm', [EventController::class, 'confirm'])->name('events.confirm');
    Route::delete('/events/{event}/images/{image}', [EventController::class, 'destroyImage'])->name('events.images.destroy');
    Route::resource('users', UserController::class)->except(['show', 'edit', 'update']);
    // Clients - Livewire
    Route::get('/clients', App\Livewire\Clients\Index::class)->name('clients.index');
    // Products - Livewire
    Route::get('/products', App\Livewire\Products\Index::class)->name('products.index');
    // Event Types - Livewire
    Route::get('/event-types', App\Livewire\EventTypes\Index::class)->name('event-types.index');
    Route::get('/calendar', App\Livewire\Calendar::class)->name('calendar.index');
    // Route::get('/calendar/events', [CalendarController::class, 'events'])->name('calendar.events'); // Removed
});

require __DIR__.'/auth.php';
