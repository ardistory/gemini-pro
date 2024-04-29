<?php

use App\Http\Controllers\AlarmController;
use App\Http\Controllers\BotTelegramController;
use App\Livewire\Dashboard;
use App\Livewire\Landingpage;
use App\Livewire\Login;
use App\Livewire\Register;
use Illuminate\Support\Facades\Route;

Route::get('/', Landingpage::class)->name('landingpage');
Route::get('/dashboard', Dashboard::class)->name('dashboard');
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');

// Bot Telegram -----------------------------------------------------------------------------

Route::get('/telegram-webhook', [BotTelegramController::class, 'getResponse']);

Route::post('/telegram-webhook', [BotTelegramController::class, 'sendResponse']);

// Office -----------------------------------------------------------------------------------

Route::get('/alarm', [AlarmController::class, 'getAlarm']);
Route::post('/alarm', [AlarmController::class, 'postAlarm']);