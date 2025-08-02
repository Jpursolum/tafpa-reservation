@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8">
    <h1 class="text-2xl font-bold mb-6">Reserve a Floating Cottage</h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('reserve.store') }}" method="POST">
        @csrf

        <input type="hidden" name="cottage_id" value="{{ $cottage->id }}">

        <div class="mb-4">
            <label class="block mb-1 font-medium">Cottage Type</label>
            <input type="text" name="cottage_type" class="w-full border rounded p-2" value="{{ $cottage->name }}" disabled>
        </div>

        <div class="mb-4">
            <label>Date</label>
            <input type="date" name="reservation_date" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label>Start Time</label>
            <input type="time" name="time_start" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label>End Time</label>
            <input type="time" name="time_end" class="w-full border rounded p-2" required>
        </div>

        <div class="mb-4">
            <label>Price</label>
            <input type="number" name="price" step="0.01" class="w-full border rounded p-2" value="{{ $cottage->price_per_day }}" disabled>
        </div>

        <div class="mb-4">
            <label>Notes</label>
            <textarea name="notes" class="w-full border rounded p-2"></textarea>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit Reservation</button>
    </form>
</div>
@endsection
