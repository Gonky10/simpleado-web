<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FlyerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoiceTranscriptionController;
use App\Http\Controllers\ImageTranscriptionController;

Route::get('/', [FlyerController::class, 'index'])->name('home');

// Flyers
Route::resource('flyers', FlyerController::class);

// Users
Route::resource('users', UserController::class);

// Voice Transcriptions
Route::resource('voice-transcriptions', VoiceTranscriptionController::class);

// Image Transcriptions
Route::resource('image-transcriptions', ImageTranscriptionController::class);
