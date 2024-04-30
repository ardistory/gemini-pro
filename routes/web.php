<?php

use App\Http\Controllers\AlarmController;
use App\Http\Controllers\BotTelegramController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Livewire\Dashboard;
use App\Livewire\Partials\EmailNotice;
use App\Livewire\Landingpage;
use App\Livewire\Login;
use App\Livewire\Partials\EmailResend;
use App\Livewire\Register;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', Landingpage::class)->name('landingpage');

Route::middleware([Authenticate::class, EnsureEmailIsVerified::class])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/api', Register::class)->name('api');
    Route::get('/test', Register::class)->name('test');
});

Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

// Verifikasi Email

Route::get('/email/verify', EmailNotice::class)->name('verification.notice')->middleware(['auth']);
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