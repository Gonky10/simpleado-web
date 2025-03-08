<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\FlyerController;
use App\Http\Controllers\InitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoiceTranscriptionController;
use App\Http\Controllers\ImageTranscriptionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;


Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/', [InitController::class, 'index'])->name('init');
Route::get('/', function () {
    // Si el usuario está autenticado, redirigir a /flyers con un mensaje de sesión iniciada
    if (Auth::check()) {
        return redirect()->route('flyers')->with('success', 'Sesión iniciada correctamente');
    }

    // Si no está autenticado, mostrar la vista del controlador InitController@index
    return app(InitController::class)->index();
})->name('init');

// Route::get('/flyers', [FlyerController::class, 'index'])->name('flyers');
Route::post('/descargar-pdf', [PDFController::class, 'generarPDF'])->name('descargar.pdf');
Route::get('/register', function () {
    return view('layout.register');
})->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');


// Ruta para la pantalla de flyers, protegida con middleware "auth"
Route::middleware(['auth'])->group(function () {
    Route::get('/flyers', [FlyerController::class, 'index'])->name('flyers');
});
