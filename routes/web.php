<?php
use App\Models\Cottage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $cottages = Cottage::where('status', 'available')->get(); // or remove filter if you want all
    return view('welcome', compact('cottages'));
});
