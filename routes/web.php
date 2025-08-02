<?php

use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;
use App\Models\Cottage;

// Homepage - open to public
Route::get('/', function () {
    $cottages = Cottage::where('status', 'available')->get();
    return view('welcome', compact('cottages'));
});

// Reservation routes - for authenticated users only
Route::middleware(['auth'])->group(function () {

    // Show reservation form for a specific cottage
    Route::get('/cottages/{id}/reserve', [ReservationController::class, 'create'])
        ->name('cottages.reserve');

    // Handle form submission and store reservation
    Route::post('/reserve', [ReservationController::class, 'store'])
        ->name('reserve.store');

});
use Illuminate\Support\Facades\Auth;
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // balik homepage after logout
})->name('logout');