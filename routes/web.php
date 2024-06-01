<?php

use App\Http\Controllers\AlarmController;
use App\Http\Controllers\ArdiPutraAppController;
use App\Http\Controllers\BotTelegramController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RedirectIfVerified;
use App\Livewire\Api;
use App\Livewire\Dashboard;
use App\Livewire\Partials\EmailNotice;
use App\Livewire\Landingpage;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\Test;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

Route::get('/', Landingpage::class)->name('landingpage');

Route::middleware([Authenticate::class, EnsureEmailIsVerified::class])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/api', Api::class)->name('api');
    Route::get('/test', Test::class)->name('test');
});

Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

// ArdiPutra APP

Route::get('/get/text', [ArdiPutraAppController::class, 'responseText']);
Route::post('/post/text', [ArdiPutraAppController::class, 'responseText']);

// Verifikasi Email

Route::get('/email/verify', EmailNotice::class)->name('verification.notice')->middleware(['auth', RedirectIfVerified::class]);
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Bot Telegram -----------------------------------------------------------------------------

Route::get('/telegram-webhook', [BotTelegramController::class, 'getResponse']);

Route::post('/telegram-webhook', [BotTelegramController::class, 'sendResponse']);

// Office -----------------------------------------------------------------------------------

Route::get('/alarm', [AlarmController::class, 'getAlarm']);
Route::post('/alarm', [AlarmController::class, 'postAlarm']);