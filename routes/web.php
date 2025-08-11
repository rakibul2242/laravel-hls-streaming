<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\VideoController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    // ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::get('/', [VideoController::class, 'uploadForm'])->name('video.uploadForm');
Route::post('/upload', [VideoController::class, 'upload'])->name('video.upload');
Route::get('/play/{name}', [VideoController::class, 'play'])->name('video.play');


Route::get('/video/{filename}', function ($filename) {
    $path = storage_path("app/public/hls/{$filename}");
    if (!File::exists($path)) abort(404);

    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $mime = $ext === 'm3u8' ? 'application/vnd.apple.mpegurl' :
            ($ext === 'ts' ? 'video/mp2t' : 'application/octet-stream');

    return Response::file($path, ['Content-Type' => $mime]);
})->name('video.stream');

require __DIR__.'/auth.php';
