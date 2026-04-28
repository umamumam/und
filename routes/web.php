<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvitationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/v/{slug}', [InvitationController::class, 'show'])->name('invitation.show');
Route::post('/v/{slug}/wish', [InvitationController::class, 'storeWish'])->name('invitation.wish.store');
Route::post('/v/{slug}/rsvp', [InvitationController::class, 'storeRSVP'])->name('invitation.rsvp.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD Invitations
    Route::resource('invitations', InvitationController::class);
    Route::get('/wishes', [InvitationController::class, 'wishes'])->name('wishes.index');
    Route::get('/wishes/{invitation}', [InvitationController::class, 'wishesDetail'])->name('wishes.show');
    Route::post('/wishes/{invitation}/add-guest', [InvitationController::class, 'addGuest'])->name('wishes.add-guest');
    Route::post('/wishes/{invitation}/update-guests', [InvitationController::class, 'updateGuests'])->name('wishes.update-guests');
});

require __DIR__ . '/auth.php';
