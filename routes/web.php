<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TicketController;

Route::get('/', [EventController::class, 'home'])->name('home');
Route::get('/events', [EventController::class, 'index'])->name('events.index');

// Breeze auth routes (assumes breeze installed)
require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function(){
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
    Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/{order}/confirm', [CheckoutController::class, 'confirm'])->name('checkout.confirm');
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{order}', [TicketController::class, 'show'])->name('tickets.show');
});
