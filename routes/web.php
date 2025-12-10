<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;

Route::get('/', [EventController::class, 'home'])->name('home');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

require __DIR__.'/auth.php'; 

Route::middleware(['auth'])->group(function () {

    Route::post('/events/{event}/checkout', [EventController::class, 'checkout'])->name('events.checkout');

    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{order}', [TicketController::class, 'show'])->name('tickets.show');
});