<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\SupportTicketSubject;
use App\Livewire\User\SupportTickets;
use App\Livewire\User\TicketDetail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/support/tickets', SupportTickets::class)->name('support.tickets');
    Route::get('/support/tickets/{ticketId}', TicketDetail::class)->name('ticket.view');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/ticket-subject', SupportTicketSubject::class)->name('admin.ticket.subject');
});
