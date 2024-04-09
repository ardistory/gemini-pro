<?php

use App\Http\Controllers\AlarmController;
use App\Http\Controllers\BotTelegramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->redirectTo('/gemini-pro');
});

Route::get('/eloquent', function () {
    return response()->view('eloquent');
});

Route::get('/gemini-pro', function () {
    return response()->view('gemini-pro');
});

Route::get('/telegram-webhook', function () {
    return response()->json(['message' => 'welcome!']);
});

Route::post('/telegram-webhook', [BotTelegramController::class, 'sendResponse']);

// Office -----------------------------------------------------------------------------------

Route::get('/alarm', [AlarmController::class, 'getAlarm']);
Route::post('/alarm', [AlarmController::class, 'postAlarm']);