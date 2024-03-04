<?php

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

