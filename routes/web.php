<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\StationController;
use App\Models\Station;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::post('/contact', [MessageController::class,'store'])->name('messages.store');

Route::view('dashboard', 'dashboard')
->middleware(['auth', 'verified'])
->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    Route::get('/stations/create', [StationController::class, 'create'])->name('stations.create');
    Route::post('/stations', [StationController::class, 'store'])->name('stations.store');
    Route::get('/stations/index', [StationController::class, 'index'])->name('stations.index');
    Route::get('/stations/{station}/show', [StationController::class, 'show'])->name('stations.show');
    Route::get('/stations/{station}/edit', [StationController::class, 'edit'])->name('stations.edit');
    Route::put('/stations/{station}', [StationController::class, 'update'])->name('stations.update');
    Route::delete('/stations/{station}', [StationController::class, 'destroy'])->name('stations.destroy');
    Route::get('/messages', [MessageController::class,'index'])->name('messages.index');
});
Route::get('/stations', function () {
    $stations = Station::all(['id', 'name', 'lat', 'lng', 'type', 'status', 'address', 'description', 'prices', 'images']);

    $grouped = $stations->groupBy('type');

    return response()->json([
        'gas_stations' => $grouped->get('gas', []),
        'petrol_stations' => $grouped->get('petrol', []),
        'fire_stations' => $grouped->get('fire', []),
    ],200);
})->name('stations');

require __DIR__ . '/auth.php';
