<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Cottage;

class ReservationController extends Controller
{
    public function create($id)
    {
        $cottage = Cottage::findOrFail($id);
        return view('reserve', compact('cottage'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cottage_id' => 'required|exists:cottages,id',
            'reservation_date' => 'required|date|after_or_equal:today',
            'time_start' => 'required',
            'time_end' => 'required',
            'price' => 'required|numeric',
            'notes' => 'nullable|string',
        ]);

        Reservation::create([
            'user_id' => auth()->id(),
            'cottage_id' => $validated['cottage_id'],
            'reservation_date' => $validated['reservation_date'],
            'time_start' => $validated['time_start'],
            'time_end' => $validated['time_end'],
            'price' => $validated['price'],
            'status' => 'pending',
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect('/')->with('success', 'Reservation request submitted!');
    }
}
